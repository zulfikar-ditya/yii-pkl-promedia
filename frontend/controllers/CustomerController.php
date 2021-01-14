<?php

namespace frontend\controllers;

use Yii;
use common\models\Customer;
use common\models\Order;
use common\models\OrderItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerController implements the CRUD actions for Customer model.
 */
class CustomerController extends Controller
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
     * Lists all Customer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Customer::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Customer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Customer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Customer();

        if (Yii::$app->request->isPost) {
            $newCustomer = new Customer();
            $request = Yii::$app->request->post('Customer');

            $newCustomer->name = $request['name'];
            $newCustomer->email = $request['email'];
            $newCustomer->user_id = Yii::$app->user->id;
            $newCustomer->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Customer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Customer model.
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
     * Finds the Customer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Customer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Customer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * jika user meload link example.host/customer/show-oreder
     * maka akan menjalankan valaidasi sebagai berikut
     * 
     * jika user belum login maka akan ke redirect ke login form/ page
     * jika user sudah login maka akan ke redirect ke link
     * 
     * example.host/customer/Show?id=1
     * 
     * id = 1 adalah id user
     */
    public function actionShowOrder() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {
            return $this->redirect(['customer/show', 'id' => Yii::$app->user->id]);
        }
    }

    /**
     * setelah kita dari page diatas dan bisa melalui proses validasi maka akan menjalankan 
     * langkah-langkah berikut
     * 
     * pertama akan mencari custommer yang ber id user sama dengan user yang di loginkan
     * 
     * kemudian akan mencari order yang dimiliki oleh custommer diatas
     * 
     * kemudian akan mencari item yang telah diorder oleh user diatas
     * 
     * dan terakhir akan didisplay pada web pages
     */
    public function actionShow($id) {
        $custommer = Customer::findOne($id);
        $order = Order::findOne($custommer->id);
        $order_item = OrderItem::find()->where(['order_id' => $order->id])->all();

        return $this->render('show-order', [
            'customer' => $custommer,
            'order' => $order,
            'order_item' => $order_item
        ]);
    }
}
