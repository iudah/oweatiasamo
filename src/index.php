<?php
$host = "127.0.0.1";
$user = "root";
$pass = "gbongbo";
$db = "owe_db";

$option = [PDO::ATTR_EMULATE_PREPARES=>false, PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];

try{
  $db_connection = new PDO("mysql:host=$host;dbname=$db", $user, $pass, $option);
}catch(Excepton $e){

}

class Word{
  public $id;
  public $proverb_idiom;
  public $translation;
  public $interpretation;
  public $background;
  public $type;
};



$sql = "select count(id) as count from proverb; ";
$stmt = $db_connection->prepare($sql);
$stmt->execute();

$n_proverbs=$stmt->fetch(PDO::FETCH_ASSOC)["count"];

session_start();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/index.css" />
    <script src="js/index.js" defer></script>
    <title>Owe Ati Asamo</title>
  </head>
  <body class="light">
    <div class="card" id="proverb">
      <h2 class="card-head">Owe</h2>
      <p><?php 
      $proverb_id=$_GET["proverb"]??random_int(1, $n_proverbs);
      $id = array( $proverb_id,
       random_int(1, $n_proverbs),
        random_int(1, $n_proverbs),
        random_int(1, $n_proverbs));

        
      
        if(isset($_GET["proverb"])){
          $_SESSION['ids']=$proverb_id;
        }else{
               if (isset($_SESSION['ids'])) {
         $id[0] = $_SESSION['ids'];
    }else{
        $_SESSION['ids'] = $id[0];
 }
      }    

 


      $sql = "select * from proverb where id=$id[0];";
      $stmt = $db_connection->prepare($sql);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, "Word");
      $word=$stmt->fetch();
    echo($word->proverb_idiom);
      ?></p>
      <h2 class="card-head">Ìtúmò</h2>
      <p><?php echo($word->interpretation); ?></p>
    </div>

    <div class="card" id="context_background">
      <!-- <h2 class="card-head">Ìtúmò / Interpretation</h2>
      <p>Lorem ...</p> -->
      <h2 class="card-head">Agbeyewo ati Lilo</h2>
      <p><?php echo($word->background); ?></p>
    </div>

    <div class="strip">
    <?php 
          $sql = "select * from proverb where  id=$id[1] or  id=$id[2] or  id=$id[3]; ";
          $stmt = $db_connection->prepare($sql);
          $stmt->execute();
          $word=$stmt->fetchAll(PDO::FETCH_CLASS, "Word");
    $limit =0;

foreach ($word as $key => $value) {
printf("<span onclick=\"goto_proverb(%d);\"><a href=\"%s?proverb=%d\">%s</a></span>",$value->id
, htmlspecialchars($_SERVER["PHP_SELF"]), $value->id, $value->proverb_idiom);
$limit++; if($limit===3)break;
}

   
    
    ?>  
    </div>

    <div class="card" id="page_suggestions">
      <h2 class="card-head">
        <span id="feedback" onclick="suggestions(1);">Got feedback?</span>
        <span id="suggest" onclick="suggestions(2);" class="s_tab_hidden"
          >Suggest a proverb</span
        >
      </h2>
      <form>
        <input type="email" placeholder="Your email" /><br />
        <div id="feedback_div">
          <textarea placeholder="Feedback..."></textarea><br />
        </div>
        <div id="suggest_div" class="s_tab_hidden">
          <textarea placeholder="Proverb / Idiom"></textarea><br />
          <textarea placeholder="Meaning"></textarea><br />
        </div>
        <button type="submit">Send</button>
      </form>
    </div>

    <aside id="comments">
      <h3>Imoye</h3>
      <div id="comment_1" class="comment">
        <p><strong>User123</strong></p>
        <p>This is a comment</p>
        <!-- <button>Report</button>
        <span>Relevance score: 8.5</span> -->
      </div>
      <!-- Repeat for other comments -->
    </aside>
  </body>
</html>
