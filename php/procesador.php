<?php 
error_reporting(E_ALL ^ E_NOTICE);

$bd = new PDO('mysql:host=localhost;dbname=crud','root','putas-1997');
$rowOne = $bd->query("SELECT * FROM tblproductos")->fetchALL(PDO::FETCH_OBJ);
$countRO= count($rowOne); //Count Row One. Count cuenta la cantidad de registros o filas de la tabla. 

$c = $_POST['c'];
$d = $_GET['d']; 
$caMd= $_POST['caMd']; 
$u= $_POST['u'];

if (isset($c) && $c!='') {
	if ($c=='insert') {
		$pro = $_POST['product'];
		$qua = $_POST['quantity'];
		$pri = $_POST['price'];
		$sta=1;
		$bd->query("INSERT INTO tblproductos VALUES(null, '$pro','$qua','$pri','$sta')");
		$rowTwo = $bd->query("SELECT * FROM tblproductos")->fetchALL(PDO::FETCH_OBJ);;
		$countRT= count($rowTwo); //Count Row Two
		if ($countRT > $countRO) {
			echo 1;
		}else{
			echo 0;
		}
	}
}else if(isset($u) && $u!=''){
	if ($u=='update') {
		$proUp= $_POST['productUp'];
		$quaUp= $_POST['quantityUp'];
		$priUp= $_POST['priceUp'];
		$idUp= $_POST['idUp']; 
		$staUp=1;
		$bd->query("UPDATE tblproductos SET productoNOM = '$proUp', productoCAN = '$quaUp', productoPRE = '$priUp', productoEST = '$staUp' WHERE productoID = '$idUp'");
	}
}else if(isset($caMd) && $caMd!=''){
	if ($caMd=='formMd') {
        $idMd=$_POST['sendMd'];
        $up = $bd->query("SELECT productoID, productoNOM, productoCAN, productoPRE FROM tblproductos WHERE productoID='$idMd'")->fetch(PDO::FETCH_OBJ);
?>

<h3>Formulario para actualizar:</h3>
<table class="table table-hover table-responsive">
	<tr>
		<th>ID</th>
		<td><input type="text" name="idUp" readonly="" class="form-control" value="<?php echo $up->productoID?>"></td>
	</tr>
	<tr>
		<th>Producto</th>
		<td><input  type="text" name="productUp" required="" class="form-control" value="<?php echo $up->productoNOM ?>"></td>
	</tr>
	<tr>
		<th>Cantidad</th>
		<td>
			<input type="number" name="quantityUp"  class="form-control" value="<?php echo $up->productoCAN ?>">
		</td>
	</tr>
	<tr>
		<th>Precio</th>
		<td><input type="number" name="priceUp"  class="form-control" value="<?php echo $up->productoPRE ?>"></td>
	</tr>
	<tr>
		<td> </td>
		<td><input type="button" onclick="updateRow()" value="Actualizar datos"  class="btn btn-primary"></td>
		<td><input type="button" onclick="hideFmod()" class="btn btn-primary" value="Volver"></td>
	</tr>
</table>
<?php
    } 
}else if(isset($d) && $d!=''){ 
	if ($d=='delete') {
		$id=$_POST['id'];
		$bd->query("UPDATE tblproductos SET productoEST = '0' WHERE productoID = '$id'"); 
	}
}else{
$rowsShow = $bd->query("SELECT productoID, productoNOM, productoCAN, productoPRE FROM tblproductos WHERE productoEST='1'")->fetchALL(PDO::FETCH_OBJ);
?>

<table class="table table-hover table-responsive">
	<tr>
		<th>Id</th><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Editar</th><th>Eliminar</th>
	</tr>
	<?php foreach ($rowsShow as $rshow): ?>
	<tr >
		<td > <?php echo $rshow->productoID ?> </td>
		<td> <?php echo $rshow->productoNOM ?> </td>	
		<td> <?php echo $rshow->productoCAN ?> </td>	
		<td> <?php echo $rshow->productoPRE ?> </td>
		<td><input type="submit" name="<?php echo $rshow->productoID?>" class="btn btn-info" value="Editar"  onclick="sendData(this.name)"></td>
		<td ><input onclick="deleteRow(this.id)" id="<?php echo $rshow->productoID?>"  type="submit" name="eliminar" class="btn btn-danger" value="Eliminar"></td>
	</tr>
	<?php endforeach; ?>
</table>

<?php } ?>


 