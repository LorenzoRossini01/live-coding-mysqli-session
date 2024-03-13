<?php
require_once __DIR__.'./db/conn.php';



try {
    
// #preparo la query e bindo i parametri da passareiaia
    $query=$conn->prepare("SELECT * FROM `degrees`  WHERE `name` LIKE ?");
    $query->bind_param("s", $searched_term_query );

    $searched_term=$_GET['search']??'';
    $searched_term_query='%'.$searched_term.'%';
    // var_dump( $searched_term );
    
    
// # eseguo la query e recupero il risultato (mysqli result obj)
    $query->execute();
    $result=$query->get_result();
    
// # dichiaro array vuoto in cui conservo le righe dell' db
    $degrees=[];
    // var_dump( $result );

// # se ci sono dei risultati 
    if($result && $result->num_rows > 0) {
// # finche non ho iterato tutte le righe dei risultati passo alla successiva 
        while ($row = $result->fetch_assoc()) {
// # aggiungo la riga all'array 
            $degrees[]= $row;
        }
    } elseif($result){
        echo'0 results';
    } 
} catch (mysqli_sql_exception $e) {
    echo 'Errore nella query di recupero dei corsi di laurea'.$e->getMessage();
}

// var_dump($degrees)


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Scopri i nosti corsi di laurea</h1>
    <a href="./login.php">Login</a>
    <hr>

    <form action="#" method="GET">
        <label for="search">Cerca</label>
        <input type="text" id="search" name="search" value="<?=$searched_term?>">
        <button type="search">cerca</button>
    </form>

    <ul>
        <?php foreach($degrees as $degree):?>
        <li><?= $degree['id']?>. <b><?= $degree['name']?></b> <i><?= $degree['level']?></i></li>
        <?php endforeach;?>
    </ul>
</body>
</html>