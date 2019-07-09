<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\Book;
use common\ppython\Ppython;


class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }

    //书目ID,题名,责任者,ISBN,价格（元）,出版社,出版年,分类号,索书号,复本数
    //import books info
    public function actionImportBooksInfo($filename = 'books_demo.csv') {
        $filepathname = Yii::$app->getRuntimePath() . DIRECTORY_SEPARATOR . $filename;
        $fh = fopen($filepathname, "r");
        $i = 1;
        while (!feof($fh)) {

            $line = trim(fgets($fh));
            if (empty($line) || strlen($line) == 0) continue;
            if ($i == 1) 
            {
                $i++;
                continue;
            }

            $fields = explode(",", $line);

            $title = iconv('GBK', 'UTF-8//IGNORE', trim($fields[1]));
            $author = iconv('GBK', 'UTF-8//IGNORE', trim($fields[2]));
            $isbn = trim($fields[3]);
            $publisher = iconv('GBK', 'UTF-8//IGNORE', trim($fields[5]));
            $price1 = iconv('GBK', 'UTF-8//IGNORE', trim($fields[4]));

            $publish_date = iconv('GBK', 'UTF-8//IGNORE', trim($fields[6]));
            $class_number = iconv('GBK', 'UTF-8//IGNORE', trim($fields[7]));
            $call_number = iconv('GBK', 'UTF-8//IGNORE', trim($fields[8]));

            //-------------------------------------------
            $book = new Book();
            $book->title = $title;
            $book->author = $author;
            $book->isbn = $isbn;
            $book->publisher = $publisher;
            $book->cover_img = '';
            $book->description = '';
            $book->price = 0;
            $book->price1 = $price1;
            $book->publish_date = $publish_date;
            $book->class_number = $class_number;
            $book->call_number = $call_number;
            $book->copy_number = 0;
            $book->series_title = '-';
            $book->created_at = time();
            $book->updated_at = time();
            $book->library_id = 1;
            $book->user_id = rand(2,7);
            $book->status = 1;
            $book->save(false);
            //-------------------------------------------
            echo $title. "\t\t". $author."\t\t". $isbn ."\t\t"."\n";
            $i++;
        }
        fclose($fh);
        echo "import books info ok.\n";
    }


    public function actionGetimgs() {
        $books = Book::find()->all();
       //echo "get imges...";
        $python = new Ppython();
        $i = 1;
        foreach($books as $book)
        {
            $data = $python->py("utils.getimgs::get_imgs_url", $book->isbn);
            print($i . "--->" . $data."\n");

            $book->cover_img = $data;
            $book->save(false);
            $i++;
        }

        echo "\nget all imgs ok and save done.";
    
    }
    




}
