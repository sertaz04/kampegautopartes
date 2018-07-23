<?php
 
      $consultaGrupo = $_POST['grupo'];
      $consultaFamilia = $_POST['familia'];
      $consultaSubFamilia = $_POST['subfamily'];
      $consultaCodigo = $_POST['codigo'];
      $consultaDescripcion = $_POST['descripcion'];
      
      if(!empty($consultaGrupo) || !empty($consultaFamilia) || !empty($consultaSubFamilia) || !empty($consultaCodigo) || !empty($consultaDescripcion)) {
            buscar($consultaGrupo, $consultaFamilia, $consultaSubFamilia, $consultaCodigo, $consultaDescripcion);
      }
       
      function buscar($consultaGrupo, $consultaFamilia, $consultaSubFamilia, $consultaCodigo, $consultaDescripcion) {
            include('../connect.php');
       
            $sqlBuscar = mysql_query(
            		"SELECT
					p.stock+
            			-- compras
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' and pi.date_create < '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' and pi.date_create < '2017-12-31') else 0 end
            		+
            		case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24))>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' and pi.date_create >= '2017-12-31' AND pu.tipo_documento_id not in (30, 24)) else 0 end
            		
					
					- -- NC compra
						case when (select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31')>0 then
            		(select sum(pi.qty) from purchases_item pi LEFT JOIN purchases pu ON pu.transaction_id = pi.invoice where pi.product_id = p.product_id AND pi.empresa_id = $sesionEmpresaID AND pi.sucursal_id = $sesionSucursalID AND pi.`delete`='0' AND pu.tipo_documento_id in (30, 24) and pi.date_create > '2017-12-31') else 0 end
					-
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		
					
					- -- ventaBoleta
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and so.date_create > '2017-12-31')>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice where s.tipo_documento_id = 13 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and so.date_create > '2017-12-31') else 0 end
					+
            		case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
					-
					case when(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order so RIGHT JOIN sales s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					
					-
						case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (13, 12, 26) AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 
            		+
            		case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
            		(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id = 24 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end 						
					-
					case when(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0)>0 then
					(select sum(so.qty) from sales_order_history so RIGHT JOIN sales_history s ON s.transaction_id = so.invoice RIGHT JOIN claveSII cs ON cs.id_invoice = s.transaction_id where s.tipo_documento_id in (14,15) AND s.tipo_traslado_id = 5 AND so.product_id = p.product_id AND so.empresa_id = $sesionEmpresaID AND so.sucursal_id = $sesionSucursalID AND so.`delete`='0' and cs.folio_DTE>0) else 0 end
					as stock ,
            		p.name, p.product_id, p.code, p.codebar, g.group_label, f.family_label, sf.subfamily_label
            		FROM products p
            		LEFT JOIN `group` g
            		ON g.group_id = p.group_id
            		LEFT JOIN `family` f
            		ON f.family_id = p.family_id
            		LEFT JOIN subfamily sf
            		ON sf.subfamily_id = p.subfamily_id
            		WHERE p.empresa_id = $sesionEmpresaID AND p.sucursal_id=$sesionSucursalID AND p.`delete`='0'
            		 AND g.`group_label` like '%$consultaGrupo%'
					 AND f.`family_label` like '%$consultaFamilia%'
					 AND sf.`subfamily_label` like '%$consultaSubFamilia%'
					 AND p.`code` like '%$consultaCodigo%'
            		 AND p.`name` like '%$consultaDescripcion%'
            		");
                       
            $contar = mysql_num_rows($sqlBuscar);
             
            if($contar == 0){
                  echo "No se han encontrado resultados para '<b>"."AND g.`group_label` like '%$consultaGrupo%'
					 AND f.`family_label` like '%$consultaFamilia%'
					 AND sf.`subfamily_label` like '%$consultaSubFamilia%'
					 AND p.`code` like '%$consultaCodigo%'"."</b>'.ss ".$contar." ss".$consultaGrupo." zz";
            }else{
                  while($row=mysql_fetch_array($sqlBuscar)){
                         
                        //echo $id." - ".$nombre."<br /><br />";
                        echo "<option value=".$row['product_id'].">".$row['group_label']." - ".$row['family_label']." - "
                        		.$row['subfamily_label']." - ".$row['code']." - "
                        		.$row['name']." | Stock : ".$row['stock']."</option>";
                  }
            }
      }
       
?>