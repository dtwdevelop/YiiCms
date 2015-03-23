<?php

namespace app\controllers;

use app\models\Categories;
use app\models\Page;
use app\modules\user\models\Profile;
use app\modules\media\models\Medias;
use app\models\SearchForm;
use ZendSearch\Lucene\Lucene;
use ZendSearch\Lucene\Document;
use ZendSearch\Lucene\Document\Field;
use ZendSearch\Lucene\Search\QueryParser;
use Yii;

class SearchController extends \yii\web\Controller {

    public function actionSearch() {
        $req = Yii::$app->request;
        $search = new SearchForm;

        if ($search->load(Yii::$app->request->get())) {
            $this->Create($search->type);
            $find = $search->q;


            $query = QueryParser::parse($find, 'UTF-8');
            $index = Lucene::open(Yii::$app->params['index']);
            $hits = $index->find($query);


            return $this->render('search', ['model' => $search, 'rezult' => $hits]);
        } else {
            return $this->render('search', ['model' => $search, 'rezult' => null]);
        }
    }

    public function Create($type=1) {
    $index = Lucene::create(Yii::$app->params['index']);
        switch ($type){
            case 1:{
                $model = Profile::find()->all();
                if ($model !== null) {
            foreach ($model as $val) {
                $document = new Document();
                $document->addField(Field::unIndexed('se_id', $val->profile_id));
                $document->addField(Field::text('title', $val->name));
                $document->addField(Field::unStored('date', $val->created));

                $index->addDocument($document);
            }
        }
                break;
            }
            case 2:{
                 $categories = Categories::find()->all();
                  if ($categories !== null) {
            foreach ($categories as $cat) {
                $document = new Document();
                $document->addField(Field::unIndexed('se_id', $cat->category_id));
                $document->addField(Field::text('title', $cat->title));
                $document->addField(Field::unStored('date', $cat->created));
                $index->addDocument($document);
            }
        }
                break;
            }
             case 3:{
                 $media = Medias::find()->all();
                  if ($media !== null) {
            foreach ($media as $cat) {
                $document = new Document();
                $document->addField(Field::unIndexed('se_id', $cat->media_id));
                $document->addField(Field::text('title', $cat->title));
                $document->addField(Field::unStored('date', $cat->created));
                $index->addDocument($document);
            }
        }
                break;
            }
        default :{
             $model = Profile::find()->all();
              foreach ($model as $val) {
                $document = new Document();
                $document->addField(Field::unIndexed('id', $val->profile_id));
                $document->addField(Field::text('title', $val->name));
                $document->addField(Field::unStored('date', $val->created));

                $index->addDocument($document);
            }
               break;
        
        }
     }
        $index->optimize();
        $index->commit();
        $total = $index->numDocs();
    }

}
