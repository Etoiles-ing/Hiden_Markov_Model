<?php 

session_start();

function create0Matrix($n){
    //create a n*n+1 Matrix with (+2 is the count list of the line and column sum)
    $markovModelMatrix = array();
    $markovModelMatrixLineCount = array();
    for ($i = 0; $i < $n; $i++) {
        $markovModelMatrix[$i] = array();
        for ($j = 0; $j < $n; $j++) {
            $markovModelMatrix[$i][$j] = array(0,0,0);
        }
        $markovModelMatrixLineCount[$i] = 0;
        $markovModelMatrixPrevLineCount[$i] = 0;
    }
    
    return array($markovModelMatrix, $markovModelMatrixLineCount, $markovModelMatrixPrevLineCount);
}

function updateMarkovMatrix($markovModelMatrix, $markovModelMatrixLineCount, $markovModelMatrixPrevLineCount, $currentPage, $nextPage){
    //increase a cellule of the matrix and update the line and column impacted the cellule changed
    $markovModelMatrix[$currentPage][$nextPage][0] += 1;
    $markovModelMatrixLineCount[$currentPage] += 1;
    $markovModelMatrixPrevLineCount[$nextPage] += 1;
    foreach ($markovModelMatrix[$currentPage] as &$markovModelMatrixColumn ){
        $markovModelMatrixColumn[1] = $markovModelMatrixColumn[0]/$markovModelMatrixLineCount[$currentPage];
    }
    foreach ($markovModelMatrix as &$markovModelMatrixLine ){
        $markovModelMatrixLine[$nextPage][2] = $markovModelMatrixLine[$nextPage][0]/$markovModelMatrixPrevLineCount[$nextPage];
    }
    return array($markovModelMatrix, $markovModelMatrixLineCount, $markovModelMatrixPrevLineCount);
}    

function updatePageInfo($currentPage, $nextPage){
    //update the new varible of the page before return it
    if ($currentPage) {
        $prevPage = $currentPage;
    } else {
        $prevPage = null;
    }
    $currentPage = $nextPage;
    return array($currentPage, $prevPage);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start of the script
    // Recovery of the different variables
    $nextPage = $_POST['nextPage'];
    $currentPage = $_POST['currentPage'];
    $markovModelMatrix = $_SESSION['markovModelMatrix'];
    $markovModelMatrixLineCount = $_SESSION['markovModelMatrixLineCount'];
    $markovModelMatrixPrevLineCount = $_SESSION['markovModelMatrixPrevLineCount'];

}
    //print_r($_POST['markovModelMatrix']);
    //echo $markovModelMatrix;
//Créer une matrice de 0

if (!$markovModelMatrix){
    //creation of the matrix if it doesn't exist
    $n = 5;
    list($markovModelMatrix, $markovModelMatrixLineCount, $markovModelMatrixPrevLineCount) = create0Matrix($n);
}

//udate the value in MarkovMatrix and the states of the page
list($markovModelMatrix, $markovModelMatrixLineCount, $markovModelMatrixPrevLineCount) = updateMarkovMatrix($markovModelMatrix, $markovModelMatrixLineCount, $markovModelMatrixPrevLineCount, $currentPage, $nextPage);
list($currentPage, $prevPage) = updatePageInfo($currentPage, $nextPage);

//upload new values in sessions variables to be used in the main
$_SESSION['markovModelMatrix'] = $markovModelMatrix;
$_SESSION['markovModelMatrixLineCount'] = $markovModelMatrixLineCount;
$_SESSION['markovModelMatrixPrevLineCount'] = $markovModelMatrixPrevLineCount;
$_SESSION['prevPage'] = $prevPage;
$_SESSION['currentPage'] = $currentPage;

//index redirection
header('Location: index.php')

?>