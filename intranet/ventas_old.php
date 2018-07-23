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
       <h2>Venta</h2>
                                                            
        <form action="incoming.php" method="post" >
                                                    
        <input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
        <input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
        <div class="row">
            <div class="col-sm-8">
            	<select name="product" class="form-control" required>
                <option></option>
                    <?php
                    include('../connect.php');
                    $result = mysql_query("SELECT g.group_label, f.family_label, 
                                                    sf.subfamily_label, p.name, p.product_id, p.code 
                                            FROM products p 
                                            LEFT JOIN `group` g ON p.group_id = g.group_id 
                                            LEFT JOIN family f ON f.family_id = p.family_id 
                                            LEFT JOIN subfamily sf ON sf.subfamily_id = p.subfamily_id");
                    while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                    {
                    ?>
                        <option value="<?php echo $row['product_id'];?>"><?php echo $row['group_label']; ?> - <?php echo $row['family_label']; ?> - <?php echo $row['subfamily_label']; ?> |  <?php echo $row['code']; ?> - <?php echo $row['name']; ?></option>
                    <?php
                                }
                            ?>
                </select>
            </div>
            <div class="col-sm-2"><input type="number" name="qty" value="1" min="1" placeholder="Cantidad" autocomplete="off" required />
            </div>
            <div class="col-sm-2">
            	<button type="submit" class="btn btn-info" style="width: 123px; height:35px; margin-top:-5px;" /><i class="icon-plus-sign icon-large"></i> Agregar</button>
            </div>
        </div>
        <input type="hidden" name="discount" value="" autocomplete="off" style="width: 68px; height:30px; padding-top:6px; padding-bottom: 4px; margin-right: 4px; font-size:15px;" />
        <input type="hidden" name="date" value="<?php echo date("m/d/y"); ?>" />
        </form>
        <table class="table table-bordered" id="resultTable" data-responsive="table">
            <thead>
                <tr>
                    <th> Nombre Producto </th>
                    <th> Nombre Gen&eacute;rico </th>
                    <th> Categor&iacute;a / Descripci&oacute;n </th>
                    <th> Precio </th>
                    <th> Cantidad </th>
                    <th> Monto </th>
                    <th> Ganancia </th>
                    <th> Acci&oacute;n </th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                        $id=$_GET['invoice'];
                        include('../connect.php');
                        $result = mysql_query("SELECT * FROM sales_order WHERE invoice= '$id'");
                        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                        {
                    ?>
                    <tr class="record">
                    <td hidden><?php echo $row['product']; ?></td>
                    <td><?php echo $row['product_code']; ?></td>
                    <td><?php echo $row['gen_name']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>
                    <?php
                    $ppp=$row['price'];
                    echo formatMoney($ppp, true);
                    ?>
                    </td>
                    <td><?php echo $row['qty']; ?></td>
                    <td>
                    <?php
                    $dfdf=$row['amount'];
                    echo formatMoney($dfdf, true);
                    ?>
                    </td>
                    <td>
                    <?php
                    $profit=$row['profit'];
                    echo formatMoney($profit, true);
                    ?>
                    </td>
                    <td width="90"><a href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['product'];?>"><button class="btn btn-mini btn-warning"><i class="icon icon-remove"></i> Cancelar </button></a></td>
                    </tr>
                    <?php
                        }
                    ?>
                    <tr>
                    <th> </th>
                    <th>  </th>
                    <th>  </th>
                    <th>  </th>
                    <th>  </th>
                    <td> Monto Total: </td>
                    <td> Ganancia Total: </td>
                    <th>  </th>
                </tr>
                    <tr>
                        <th colspan="5"><strong style="font-size: 12px; color: #222222;">Total:</strong></th>
                        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                        <?php
                        function formatMoney($number, $fractional=false) {
                            if ($fractional) {
                                $number = sprintf('%.2f', $number);
                            }
                            while (true) {
                                $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
                                if ($replaced != $number) {
                                    $number = $replaced;
                                } else {
                                    break;
                                }
                            }
                            return $number;
                        }
                        $sdsd=$_GET['invoice'];
                        
                        $resultas = mysql_query("SELECT sum(amount) FROM sales_order WHERE invoice= '$sdsd'");
                        while($rowas = mysql_fetch_array($resultas, MYSQL_ASSOC))
                        {
                        $fgfg=$rowas['sum(amount)'];
                        echo formatMoney($fgfg, true);
                        }
                        ?>
                        </strong></td>
                        <td colspan="1"><strong style="font-size: 12px; color: #222222;">
                    <?php 
                        $resulta = mysql_query("SELECT sum(profit) FROM sales_order WHERE invoice= '$sdsd'");
                        while($qwe = mysql_fetch_array($resulta, MYSQL_ASSOC))
                        {
                        $asd=$qwe['sum(profit)'];
                        echo formatMoney($asd, true);
                        }
                        ?>
                
                        </td>
                        <th></th>
                    </tr>
            </tbody>
        </table><br>
        <a rel="facebox" href="checkout.php?pt=<?php echo $_GET['id']?>&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $fgfg ?>&totalprof=<?php echo $asd ?>&cashier=<?php echo $_SESSION['SESS_FIRST_NAME']?>"><button class="btn btn-success btn-large btn-block"><i class="icon icon-save icon-large"></i> Guardar</button></a>
        <div class="clearfix"></div>
        </div>
	</body>
</html>