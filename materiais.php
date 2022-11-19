<?php

require_once("PDO.php");

$database = new Database;

$conn = $database->connect("smart_gip_pecabostoagostinho");

if ($_POST['tipoRelatorio']) {
    
}


$sql = "SELECT * FROM estoque as e JOIN materiais as m on e.idmaterial = m.id
JOIN pontos as p on e.idponto = p.id JOIN ordem_servicos AS o on e.protocolo = o.protocolo
JOIN grupo_materiais as g on m.grupo_id = g.id
WHERE e.data BETWEEN '2022-02-02  00:00:00' AND '2022-02-11 23:59:00'";

/*
$sql = "SELECT * FROM estoque as e join materiais as m on e.idmaterial = m.id
WHERE e.data BETWEEN '2022-02-02  00:00:00' AND '2022-02-11 23:59:00'";
*/

$movimentacaoMaterial = $_POST['movimentacaoMaterial'];

$ponto = $_POST['ponto'];

$bairro = $_POST['bairro'];

$rua = $_POST['rua'];

$nome_tecnico = $_POST['equipe'];


if (!empty($movimentacaoMaterial)) $sql = "$sql AND e.movimentacao='$movimentacaoMaterial'";

if (!empty($ponto)) $sql = "$sql AND p.id=$ponto";

if (!empty($bairro)) $sql = "$sql AND bairro LIKE '%$bairro%'";

if (!empty($rua)) $sql = "$sql AND rua LIKE '%$rua%'";

if (!empty($nome_tecnico)) $sql = "$sql AND nome='$nome_tecnico'";




$stmt = $conn->prepare($sql);


$stmt->execute();


$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>

<style >
   
        body{
            font-family: Verdana, Geneva, sans-serif;
            font-size: 15px;
        }

        #outPopUp {
            position: absolute;
            width: 300px;
            height: 200px;
            z-index: 15;
            top: 35%;
            left: 20%;
            margin: -100px 0 0 -150px;
        }


        .pagebreak {
            page-break-before: always;
        }

    </style>

    <div class="col col-md-6">

     <p class="text-start fs-4 fw-bold">Prefeitura Municipal do <?php ?> </p>
     <p class="text-start fs-6">Relatório de materiais: <?php ?> <br />

     Emissão: <?php echo date('d/m/Y H:i'); ?> <br />
     Período: <?php //echo (new DateTime($periodo_inicial))->format('d/m/Y') ?> - <?php //echo (new DateTime($periodo_final))->format('d/m/Y') ?></p>

    </div>
    

<div class="row">

    <div class="col-12">

        <div class="col col-md-6">

        <div class="table-responsive">


        <div id="outPopUp">
        <table class="table table-striped table-bordered" width="100%">

         
                <thead>
                    <th scope="col">Ponto</th>
                    <th scope="col">Código</th>
                    <th scope="col">Material</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Protocolo</th>
                    <th scope="col">Movimentação</th>
                    <th scope="col">Data</th>
                </thead>

                <tbody>
                    <tr>

                        <?php 
        
                        foreach ($dados as $value) {

                           

                            echo '<tr>';
                            echo "<td colspan='1'>".$value['idponto']."</td>";
                            echo "<td colspan='1'>".$value['codigo']."</td>";
                            echo "<td colspan='1'>".$value['descricao']."</td>";
                            echo "<td colspan='1'>".$value['grupo']."</td>";
                            echo "<td colspan='1'>".$value['protocolo']."</td>";
                            echo "<td colspan='1'>".$value['movimentacao']."</td>";
                            echo "<td colspan='1'>".$value['data']."</td>";
                            echo '</tr>';
                        }

                        
                        
                        ?>
                    </tr>
                </tbody>
           


        </table>
        </div>
    

        </div>  

        </div>


    </div>

</div>
<div class="pagebreak"> </div>

        <script>
            window.print();
            window.addEventListener("afterprint", function(event) { window.close(); });
            window.onafterprint();

        </script>

</body>
</html>

<?php

?>
