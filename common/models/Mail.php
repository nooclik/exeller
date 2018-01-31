<?php
/**
 * Created by PhpStorm.
 * User: Админ
 * Date: 09.08.2017
 * Time: 10:47
 */

namespace common\models;


class Mail
{
    public $to;
    public $from;
    public $text;
    public $subject;
    public $headers;
    public $category;

    function __construct($to, $categoty, $type_post)
    {
        $this->to = 'ee@mail.ru';
        //$this->text = $text;

        $this->subject = "Birthday Reminders for August";

        $this->text = ' 
            <html> 
                <head> 
                    <title>Birthday Reminders for August</title> 
                </head> 
                <body> 
                    <p>Here are the birthdays upcoming in August!</p> 
                </body> 
            </html>';

        $this->headers = "Content-type: text/html; charset=windows-1251 \r\n";
        $this->headers .= "From: Birthday Reminder <birthday@example.com>\r\n";
        // $headers .= "Bcc: birthday-archive@example.com\r\n";
    }

    public function Send()
    {
        mail($this->to, $this->subject, $this->text, $this->headers);
    }

}