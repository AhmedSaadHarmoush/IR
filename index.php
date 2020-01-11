<?php

function transpose($arrayName) {
    $transpose = array();
    for ($i = 0; $i < count($arrayName); $i++) {
        for ($j = 0; $j < count($arrayName[0]); $j++) {
            $transpose[$i][$j] = $arrayName[$j][$i];
        }
    }
    return $transpose;
}

function multiply($array1, $array2) {
    $array3 = array();
    for ($i = 0; $i < count($array1); $i++) {
        $array3[$i] = 0;
        for ($j = 0; $j < count($array1[0]); $j++) {
            $array3[$i] = $array3[$i] + ($array1[$i][$j] * $array2[$j]);
        }
    }
    return $array3;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Find My file</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <?php
    $totalCounter = array();
    $allChar = array();
    $totalCounterForeachChar = array();
    $numberOfAllCharacters = 0;
    for ($i = 1; $i <= 5; $i++) {
        if ($i == 1) {
            $c = 'A';
        } elseif ($i == 2) {
            $c = 'B';
        } elseif ($i == 3) {
            $c = 'C';
        } elseif ($i == 4) {
            $c = 'D';
        } elseif ($i == 5) {
            $c = 'E';
        }
        $myfile = fopen("files/" . $c . ".txt", "r") or die("Unable to open file!");
        if (filesize("files/" . $c . ".txt") <= 0)
            continue;
        $file = fread($myfile, filesize("files/" . $c . ".txt"));
        fclose($myfile);
        $valuesFile = (explode(" ", $file));
        $elementsFile = array();
        $counterFile = array();
        $flag = 0;

        //element file contains the values of characters in each file
        foreach ($valuesFile as $value) {
            $flag = 0;
            foreach ($elementsFile as $values) {
                if ($value == $values) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                array_push($elementsFile, $value);
            }
            $flag = 0;
            foreach ($allChar as $values) {
                if ($value == $values) {
                    $flag = 1;
                }
            }
            if ($flag == 0) {
                array_push($allChar, $value);
            }
        }

        //counterfile is an array of arrays [0]->refers to a character 
        //[1]-> refers to the count of this character in file
        foreach ($elementsFile as $value) {
            $counter = array($value, 0);
            array_push($counterFile, $counter);
        }
        //counting characters
        foreach ($valuesFile as $value) {
            for ($index = 0; $index < count($counterFile); $index++) {
                if ($value == $counterFile[$index][0]) {
                    $counterFile[$index][1] ++;
                }
            }
        }
        //finding max count in file
        $max = 0;
        for ($index = 0; $index < count($counterFile); $index++) {
            if ($counterFile[$index][1] > $max) {
                $max = $counterFile[$index][1];
            }
        }
        $maxArray = array("max" => $max, "file" => $c);
        array_push($totalCounter, $maxArray);
        array_push($totalCounter, $counterFile);
        $numberOfAllCharacters+=count($valuesFile);
        //number of total count of all characters in all files
    }
//         foreach ($totalCounter as $value) {
//             print_r($value);//printing each character count
//             echo '<br>';
//         }
    ?>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="#">Find My Files</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Add Files</a></li>
                        <li><a href="#">Edit Files</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container" >
            <div class="row" style="text-align: center;">
                <img src="imgs/bg.png"/>
                <div class="col-md-12">
                    <form action=""method="post">
                        <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="form-control input-lg" name="txt" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button  class="btn btn-info btn-lg" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_POST['txt'])) {
                $query = $_POST['txt'];
                $valuesQuery = (explode(" ", $query));
                $elementsQuery = array();
                $counterQuery = array();
                $flag = 0;
                $numberOfAllCharacters+=count($valuesQuery);
                foreach ($valuesQuery as $value) {
                    $flag = 0;
                    foreach ($elementsQuery as $values) {
                        if ($value == $values) {
                            $flag = 1;
                        }
                    }
                    if ($flag == 0) {
                        array_push($elementsQuery, $value);
                    }
                    $flag = 0;
                    foreach ($allChar as $values) {
                        if ($value == $values) {
                            $flag = 1;
                        }
                    }
                    if ($flag == 0) {
                        array_push($allChar, $value);
                    }
                }
                foreach ($elementsQuery as $value) {
                    $counter = array($value, 0);
                    array_push($counterQuery, $counter);
                }


                foreach ($valuesQuery as $value) {
                    for ($index = 0; $index < count($counterQuery); $index++) {
                        if ($value == $counterQuery[$index][0]) {
                            $counterQuery[$index][1] ++;
                        }
                    }
                }

                foreach ($allChar as $value) {
                    $array = array($value, 0);
                    array_push($totalCounterForeachChar, $array);
                }
                //print_r($allChar);
                for ($i = 0; $i < count($totalCounter); $i+=2) {
                    for ($j = 0; $j < count($totalCounter[$i + 1]); $j++) {
                        for ($k = 0; $k < count($totalCounterForeachChar); $k++) {
                            if ($totalCounterForeachChar[$k][0] == $totalCounter[$i + 1][$j][0]) {
                                $totalCounterForeachChar[$k][1]+=$totalCounter[$i + 1][$j][1];
                            }
                        }
                    }
                }
                foreach ($counterQuery as $value) {
                    for ($k = 0; $k < count($totalCounterForeachChar); $k++) {
                        if ($totalCounterForeachChar[$k][0] == $value[0]) {
                            $totalCounterForeachChar[$k][1]+=$value[1];
                        }
                    }
                }
//         echo '<h2>totalcount</h2>';
//         foreach ($totalCounterForeachChar as $value) {
//             print_r($value);
//             echo '<br>';
//         }
                //calculating tf for each character in file
                $tfs = array();
                for ($index = 0; $index < count($totalCounter); $index+=2) {
                    $tf = array();
                    for ($i = 0; $i < count($totalCounter[$index + 1]); $i++) {
                        array_push($tf, $totalCounter[$index + 1][$i][0]);
                        array_push($tf, $totalCounter[$index + 1][$i][1] / $totalCounter[$index]['max']);
                    }
                    array_push($tfs, $tf);
                    array_push($tfs, $totalCounter[$index]['file']);
                }
//         foreach ($tfs as $value) {
//             print_r($value);
//             echo '<br>';
//         }
//         echo $numberOfAllCharacters.'<br>';
                $idfs = array();
                for ($i = 0; $i < count($totalCounterForeachChar); $i++) {
                    $idf = array();
                    array_push($idf, $totalCounterForeachChar[$i][0]);
                    $num = log($numberOfAllCharacters / $totalCounterForeachChar[$i][1], 10);
                    array_push($idf, $num);
                    array_push($idfs, $idf);
                }
                $tfIdfs = array();
                for ($i = 0; $i < count($tfs); $i+=2) {
                    $tfIdf = array();
                    for ($j = 0; $j < count($tfs[$i]); $j+=2) {
                        for ($k = 0; $k < count($idfs); $k++) {
                            if ($tfs[$i][$j] == $idfs[$k][0]) {
                                array_push($tfIdf, $idfs[$k][0]);
                                array_push($tfIdf, $idfs[$k][1] * $tfs[$i][$j + 1]);
                            }
                        }
                    }

                    for ($j = 0; $j < count($allChar); $j++) {
                        $flag = 0;
                        for ($k = 0; $k < count($tfIdf); $k+=2) {
                            if ($tfIdf[$k] == $allChar[$j]) {
                                $flag = 1;
                            }
                        }
                        if ($flag == 0) {
                            array_push($tfIdf, $allChar[$j]);
                            array_push($tfIdf, 0);
                        }
                    }
                    array_push($tfIdfs, $tfIdf);
                    array_push($tfIdfs, $tfs[$i + 1]);
                }
//         foreach ($tfIdfs as $value) {
//             print_r($value);
//             echo '<br>';
//         }




                $max = 0;
                for ($index = 0; $index < count($counterQuery); $index++) {
                    if ($counterQuery[$index][1] > $max) {
                        $max = $counterQuery[$index][1];
                    }
                }
                for ($index = 0; $index < count($counterQuery); $index++) {
                    $counterQuery[$index][1] = $counterQuery[$index][1] / $max;
                }
                $tfIdf = array();
                for ($index = 0; $index < count($counterQuery); $index++) {
                    for ($k = 0; $k < count($idfs); $k++) {
                        if ($counterQuery[$index][0] == $idfs[$k][0]) {
                            array_push($tfIdf, $idfs[$k][0]);
                            array_push($tfIdf, $idfs[$k][1] * $counterQuery[$index][1]);
                        }
                    }
                }
//            foreach ($tfIdfs as $value) {
//                print_r($value);
//                echo '<br>';
//            }
//           print_r($tfIdf);


                $cosSims = array();
                for ($i = 0; $i < count($tfIdfs); $i+=2) {
                    $cosSim = array();
                    $bstSum = 0;
                    $querySum = 0;
                    $fileSum = 0;
                    array_push($cosSim, $tfIdfs[$i + 1]);
                    for ($j = 0; $j < count($tfIdfs[$i]); $j+=2) {
                        for ($k = 0; $k < count($tfIdf); $k+=2) {
                            if ($tfIdfs[$i][$j] == $tfIdf[$k]) {
                                $bstSum+=($tfIdfs[$i][$j + 1] * $tfIdf[$k + 1]);
                            }
                        }
                    }
                    for ($j = 0; $j < count($tfIdfs[$i]); $j+=2) {
                        $fileSum+=$tfIdfs[$i][$j + 1] * $tfIdfs[$i][$j + 1];
                    }
                    for ($j = 0; $j < count($tfIdf); $j+=2) {
                        $querySum+=$tfIdf[$j + 1] * $tfIdf[$j + 1];
                    }
                    if ($querySum <= 0) {
                        break;
                    }
                    // echo "el bst =$bstSum ,el mkam hw $fileSum w $querySum <br> ";
                    $cosValue = $bstSum / sqrt($fileSum * $querySum);
                    array_push($cosSim, $cosValue);
                    array_push($cosSims, $cosSim);
                }

                function cmp($a, $b) {
                    return strcmp($b[1], $a[1]);
                }

                usort($cosSims, "cmp");
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>File name</th>
                            <th>Content</th>
                            <th>CosSim</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($cosSims as $value) {
                            ?>
                            <tr>
                                <td><?php echo "fileNeme :" . $value[0] . ".txt" ?></td>
                                <td>
                                    <?php
                                    $myfile = fopen("files/" . $value[0] . ".txt", "r") or die("Unable to open file!");
                                    if (filesize("files/" . $value[0] . ".txt") <= 0)
                                        continue;
                                    $file = fread($myfile, filesize("files/" . $value[0] . ".txt"));
                                    fclose($myfile);
                                    echo "$file";
                                    ?>
                                </td>
                                <td><?php echo "CosSim =" . $value[1] ?></td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <?php
            $allReferences = array(array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0));
            for ($i = 0; $i < 5; $i++) {
                if ($i == 0) {
                    $c = 'A';
                } elseif ($i == 1) {
                    $c = 'B';
                } elseif ($i == 2) {
                    $c = 'C';
                } elseif ($i == 3) {
                    $c = 'D';
                } elseif ($i == 4) {
                    $c = 'E';
                }
                $myfile = fopen("files/" . $c . ".txt", "r") or die("Unable to open file!");
                if (filesize("files/" . $c . ".txt") <= 0)
                    continue;
                $file = fread($myfile, filesize("files/" . $c . ".txt"));
                fclose($myfile);
                $valuesFile = (explode(" ", $file));
                foreach ($valuesFile as $value) {
                    for ($j = 0; $j < count($value); $j++) {
                        if ($value[$j] ==$c) {
                            
                        }elseif ($value[$j] == 'A') {
                            $allReferences[$i][0] = $allReferences[$i][0] + 1;
                        } elseif ($value[$j] == 'B') {
                            $allReferences[$i][1] = $allReferences[$i][1] + 1;
                        } elseif ($value[$j] == 'C') {
                            $allReferences[$i][2] = $allReferences[$i][2] + 1;
                        } elseif ($value[$j] == 'D') {
                            $allReferences[$i][3] = $allReferences[$i][3] + 1;
                        } elseif ($value[$j] == 'E') {
                            $allReferences[$i][4] = $allReferences[$i][4] + 1;
                        }
                    }
                }
            }
            $t = transpose($allReferences);
            $h = array(1, 1, 1, 1, 1);

            for ($i = 0; $i < 20; $i++) {
                $a = multiply($t, $h);
                $h = multiply($allReferences, $a);
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>File name</th>
                        <th>Authority</th>
                        <th>Hub</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                        if ($i == 0) {
                            $c = 'A';
                        } elseif ($i == 1) {
                            $c = 'B';
                        } elseif ($i == 2) {
                            $c = 'C';
                        } elseif ($i == 3) {
                            $c = 'D';
                        } elseif ($i == 4) {
                            $c = 'E';
                        }
                        ?>
                        <tr>
                            <td><?php echo $c; ?>.txt</td>
                            <td>
                                <?php
                                if ($a[$i] > $h[$i]) {
                                    echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($a[$i] < $h[$i]) {
                                    echo '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
                                }
                                ?> 
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <footer class = "container-fluid navbar navbar-fixed-bottom" style = "text-align: right;">
            <p>Copy Rights &copy;
                Ahmed Harmoush </p>
        </footer>
    </body>
</html>
