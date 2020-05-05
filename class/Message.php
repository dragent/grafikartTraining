<?php


class Message
{

    const LIMIT_USERNAME = 3;
    const LIMIT_MESSAGE = 10;
    private $username;
    private $message;
    private $date;


    public function __construct(string $username, string $message, DateTime $date=null)
    {
        $this->date= $date ?: new DateTime();
        $this->username=$username;
        $this->message=$message;
        date_default_timezone_set("Europe/Paris");
    }

    /**
     * @return bool
     *
     * vérifie s'il n y a pas d erreur dans le message
     */
    public function isvalid() : bool
    {
        return empty($this->getErrors());
    }


    /**
     * @return array
     *
     * Récupère les erreurs et renvoie un tableau
     */
    public function getErrors() : array
    {
        $error=[];
        if(strlen($this->username)<self::LIMIT_USERNAME)
        {
            $error+=["Username"=>"Pseudo trop court"];
        }
        if(strlen($this->message)<self::LIMIT_MESSAGE)
        {
            $error+=["Message"=>"Message trop court"];
        }
        return $error;
    }


    /**
     * @return string
     *
     * transforme un message en format HTML
     */
    public function toHtml()
    {
        $date= $this->date->format("Y-m-d à H:i:s");
        if($this->date!=null)
        $text=<<<HTML
        <p>
            <strong>$this->username</strong> <em>le $date </em></br>
            $this->message
</p>
HTML;
        else
        {
            $text=<<<HTML
        <p>
            <strong>$this->username</strong></br>
            $this->message
</p>
HTML;
        }
        return $text;
    }

    /**
     * @return string
     * transfome un message en format json
     */
    public function toJson():string
    {
        $data=serialize(array("Username",$this->username," , Message",$this->message," , Date",$this->date));
        return json_encode($data);
    }


    /**
     * @param string $code
     * @return Message
     * @throws Exception
     * decode une chaine de caracter et place les information dans un objet message qui est renvoyé
     */
    public static function fromJSON( string $code):Message
    {
        $message=json_decode($code);
        $message=unserialize($message);
        return new Message($message[1],$message[3],new DateTime($message[5]->format("Y-m-d H:i:s")));
    }
}