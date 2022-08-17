<?



class Person {
    public $name;
    public $surname;
    public $bdate;

    public function __construct($name, $surname, $bdate){
        $this->name=$name;
        $this->surname=$surname;
        $this->bdate=$bdate;
    }

    function PrintNameSur() {
        echo $this->name."   ". $this->surname;
    }
}

class Director extends Person{
    public $dImg = '';
    public $dInfo = '';

    public function __construct($name, $surname, $bdate,$img, $info) {
        parent::__construct($name, $surname, $bdate);
        $this->dImg=$img;
        $this->dInfo=$info;
    }

}

class Actor extends Person{
    public $aImg = '';
    public $aVideo = '';

    public function __construct($name, $surname, $bdate,$img, $video) {
        parent::__construct($name, $surname, $bdate);
        $this->aImg=$img;
        $this->aVideo=$video;
    }

}

class User extends Person{
    public $uLogin = '';
    public $uPass = '';

    public function __construct($name, $surname, $bdate,$log, $pass) {
        parent::__construct($name, $surname, $bdate);
        $this->uLogin=$log;
        $this->uPass=$pass;
    }
}


class Movie 
{
// public $mID;
public $mName = '';
public $mYear = '';
public $mContry = '';
public $mGenre = '';
public $mTiming = '';
public $mBudget = '';
public $mTrailer = '';
public $mPoster = '';
public $mDescr = '';
public $mActor;
public $mDirector;

function PrintName() {
    echo $this->mName;
}


public function __construct( $name, $year, $contry,$genre, $timing,$budget, $trailer,$poster, $descr, Actor $actor, Director $director) {
    // $this->mID=$id;
    $this->mName=$name;
    $this->mYear=$year;
    $this->mContry=$contry;
    $this->mGenre=$genre;
    $this->mTiming=$timing;
    $this->mBudget=$budget;
    $this->mTrailer=$trailer;
    $this->mPoster=$poster;
    $this->mDescr=$descr;
    $this->mActor=$actor;
    $this->mDirector=$director;
}

}

class Response
{
    public $rUser;
    public $rFilm;
    public $rText;

    public function __construct(User $user, $film, $resp){
        $this->rUser=$user;
        $this->rFilm=$film;
        $this->rText=$resp;
    }
}

?>
