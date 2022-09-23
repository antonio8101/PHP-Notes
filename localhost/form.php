<html>
<head>
    <title>something</title>
</head>
</html>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    var_dump($_POST);
}
?>
<form method="POST">
    Nome: <input type="text" name="nome" value="<?=$_POST['nome']?>"><br>
    Cognome: <input type="text" name="cognome" value="<?=$_POST['cognome']?>"><br>
    <select name="attributes[]" multiple>
        <option value="one" <?=array_search( 'one', $_POST['attributes'] ) ? null : 'selected'  ?>>one</option>
        <option value="two">two</option>
        <option value="3" >3</option>
        <option value="4" >4</option>
    </select>
    <br><br>
    <input type="checkbox" name="cktest[]" value="one">one <br>
    <input type="checkbox" name="cktest[]" value="two">two <br>
    <input type="checkbox" name="cktest[]" value="3">3 <br>
    <input type="checkbox" name="cktest[]" value="4">4 <br>

    <input type="hidden" name="id" value="something">
    <input type="submit" value="chunkify">
</form>
</body>
