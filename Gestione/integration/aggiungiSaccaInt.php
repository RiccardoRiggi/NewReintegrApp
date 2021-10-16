<?php
    include '../business/saccheBusiness.php';

    function generaComboPosizioneSacca(){
        $finale='';
        $result = selezionaListaPosizioni();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $finale=$finale.'<option value="'.$row["id"].'">'.$row["nome"].'</option>';
            }
        }
        return $finale;
    }

    function salvaSacca($nome,$colore,$padre){
        if($nome=="" || $colore=="" || $padre=="")
            header('location: errore500.php');    
        if(substr($padre,0,1)=='Z'){
            $id=salvaSaccaZaino($nome,$colore,substr($padre,1,strlen($padre)));
        }else{
            $id=salvaSaccaMezzo($nome,$colore,substr($padre,1,strlen($padre)));
        }
        if($id!=0)
            header('location: modificaSacca.php?id='.$id);
        else
            header('location: errore500.php');    
    }

?>