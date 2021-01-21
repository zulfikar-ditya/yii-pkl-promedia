<?php

namespace backend\controllers;

use Yii;
use common\models\Item;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use backend\models\Statistic;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Item models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Item::find(),
        ]);

        $newStats = new Statistic();
        $newStats->datetime = date('Y-m-d H:m:s');
        $newStats->user_ip = Yii::$app->request->userIP;
        $newStats->user_host = Yii::$app->request->userHost;
        $newStats->path_info = Yii::$app->request->pathInfo;
        $newStats->query_string = Yii::$app->request->queryString;
        $newStats->save();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $newStats = new Statistic();
        $newStats->datetime = date('Y-m-d H:m:s');
        $newStats->user_ip = Yii::$app->request->userIP;
        $newStats->user_host = Yii::$app->request->userHost;
        $newStats->path_info = Yii::$app->request->pathInfo;
        $newStats->query_string = Yii::$app->request->queryString;
        $newStats->save();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Item model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Item();

        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post('Item');
            $model->name = $request['name'];
            $model->price = $request['price'];
            $model->category_id = $request['category_id'];

            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image && $model->validate()) { // validasi image
                $image_name = $model->name.'.'.$model->image->getExtension(); // mendefinisikan nama
                $image_path = 'images/item/'.$image_name; // lokasi image akan disimpan
                $model->image->saveAs($image_path); // memmindah file ke folder
                $model->image = $image_path; // menambahkan link menujut file
            }
            $model->save(false); // save tanpa validasi lagi
            return $this->redirect(['view', 'id' => $model->id]); // return ke detail view
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Item model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $request = Yii::$app->request->post('Item');
            $model->name = $request['name'];
            $model->price = $request['price'];
            $model->category_id = $request['category_id'];

            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model->image && $model->validate()) { // validasi image
                $image_name = $model->name.'.'.$model->image->getExtension(); // mendefinisikan nama
                $image_path = 'images/item/'.$image_name; // lokasi image akan disimpan
                $model->image->saveAs($image_path); // memmindah file ke folder
                $model->image = $image_path; // menambahkan link menujut file
            }
            $model->save(false); // save tanpa validasi lagi
            return $this->redirect(['view', 'id' => $model->id]); // return ke detail view
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Item model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Item model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Item the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Item::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
