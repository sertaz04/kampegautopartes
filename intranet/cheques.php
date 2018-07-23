<html>
    <head>
        <title>Kampeg ERP</title>
        <!--Se incluyen las hojas de estilo de bootstrap-->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/jquery-2.2.3.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
        <?php
			require_once('auth.php');
		 ?>
        
    </head>
    <body>
		<?php include('navfixed.php');?>
       <div class="container">
          <h2>Lista de cheques</h2>
			<input type="text" name="filter" style="height:35px; margin-top: -1px;" value="" id="filter" placeholder="Buscar cheques..." autocomplete="off" />
<br><br>
          <table class="table table-bordered" id="resultTable" data-responsive="table" style="text-align: left;">
            <thead>
                <tr>
                    <th width="5%"> N&uacute;mero documento</th>
                    <th width="10%"> Fecha documento</th>
                    <th width="25%"> Cliente </th>
                    <th width="10%"> N&uacute;mero cheque </th>
                    <th width="15%"> Fecha cheque </th>
					<th width="15%"> Fecha pago </th>
                    <th width="10%"> Banco </th>
                    <th width="10%"> Monto</th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        include('../connect.php');
                        $result = mysql_query("SELECT cs.folio_DTE, s.fecha_factura, c.rut, c.customer_name, vi.numero_cheque, 
														vi.fecha as fechaCheque, vi.fecha_pago, b.banco_name, vi.monto 
												FROM ventas_impago vi 
												LEFT JOIN claveSII cs ON vi.transaction_id = cs.id_invoice
												LEFT JOIN sales s ON vi.transaction_id = s.transaction_id
												LEFT JOIN customer c ON c.customer_id = vi.customer_id
												LEFT JOIN bancos b ON b.banco_id = vi.banco 
                        						WHERE vi.empresa_id = $sesionEmpresaID AND vi.`delete`='0'
                        						  AND cs.folio_DTE > 0
                        						ORDER BY vi.transaction_id DESC");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td><?php echo $row['folio_DTE']; ?></td>
                    <td><?php echo $row['fecha_factura']; ?></td>
                    <td><?php echo $row['rut'].' - '.$row['customer_name']; ?></td>
                    <td><?php echo $row['numero_cheque']; ?></td>
                    <td><?php echo $row['fechaCheque']; ?></td>
                    <td><?php echo $row['fecha_pago']; ?></td>
                    <td><?php echo $row['banco_name']; ?></td>
                    <td><?php echo $row['monto']; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                
            </tbody>
         </table>
        </div>
	</body>
</html>