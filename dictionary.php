<!DOCTYPE html>
<html>
<head>
    <title>Dictionary</title>
    <meta charset="utf-8" />
    <link href="dictionary.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>My Dictionary</h1>
<!-- Ex. 1: File of Dictionary -->

    <?php 
        $filename = "dictionary"; 
        $lines=file($filename . ".tsv");

        echo $filename . " has " . count($lines) . " total words\n and\n size of ";
        echo filesize($filename . ".tsv");
        echo " bytes.";
    ?>
</div>
<div class="article">
    <div class="section">
        <h2>Today's words</h2> <ol>
<!-- Ex. 2: Today’s Words & Ex 6: Query Parameters -->
        <?php
            $numberOfWords=rand(1,count($lines));

            function getWordsByNumber($listOfWords, $numberOfWords){
                $resultArray = array();
                $count = 0;
                foreach ($numberOfWords as $key=> $value) {
                    if($key >= $numberOfWords){
                        break;
                    }
                    array_push($resultArray,$value);
                }
                return $resultArray;

            }
            $todayWord = getWordsByNumber($lines,$numberOfWords);

            print $todayWord[0];

        ?> </ol>
        <ol>
            <li>Apple - An apple is a round fruit with smooth green, yellow, or red skin and firm white flesh.</li>
            <li>Computer - A computer is an electronic machine that can store and deal with large amounts of information.</li>
            <li>Graduate - A graduate is a person who has successfully completed a degree at a university or college and has received a certificate that shows this.</li>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Words</h2>
<!-- Ex. 3: Searching Words & Ex 6: Query Parameters -->
        <p>
            Words that started by <strong>'C'</strong> are followings :
        </p> 
        <ol>
        <?php
            $startCharacter = 'C';
            function getWordsByCharacter($listOfWords, $startCharacter){
                $resultArray = array();
                foreach ($listOfWords as $key => $value) {
                    $pos = strpos($value,$startCharacter);
                    if($pos === false){

                    }else{
                        array_push($resultArray, $value);
                    }
                }

                return $resultArray;
            }

            $SearchingWord = getWordsByCharacter($lines,$startCharacter);
            foreach ($SearchingWord as $key => $value) { ?>
                <li><?= $value ?></li> <?php 
            }
        ?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Words</h2> 
        <p>
            All of words ordered by <strong>alphabetical order</strong> are followings :
        </p>
        <ol>
<!-- Ex. 4: List of Words & Ex 6: Query Parameters -->
        <?php
            $orderby=0;
            if($orderby==0)

            function getWordsByOrder($listOfWords, $orderby){
                $resultArray = $listOfWords;
                if($orderby == 0){
                    sort($listOfWords);
                    foreach ($listOfWords as $key => $value) {
                        array_push($resultArray,$value);
                    }

                }else if($orderby == 1){
                    rsort($listOfWords);
                                        foreach ($listOfWords as $key => $value) {
                        array_push($resultArray,$value);
                    }
                }

                return $resultArray;
            }

            $orderWord = getWordsByOrder($lists,0);
            foreach ($orderWord as $key => $value) { ?>
                <li><?= $value ?></li> <?php 
            }
        ?> </ol>
    </div>
    <div class="section">
        <h2>Adding Words</h2>
<!-- Ex. 5: Adding Words & Ex 6: Query Parameters -->
        <p>Input word or meaning of the word doesn't exist.</p>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>
