<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\db\ActiveRecord;

use app\models\Req1;
use app\models\Req2;
use app\models\Req3;
use app\models\Req4;
use app\models\Req5;
use app\models\Req6;
use app\models\Req7;
use app\models\Req8;
use app\models\Req9;
use app\models\Req10;
use app\models\Req11;
use app\models\Req12;
use app\models\Req13;
use app\models\Req14;
use app\models\Req15;
use app\models\Req16;

use app\modules\admin\models\Abonement;
use app\modules\admin\models\Author;
use app\modules\admin\models\Employee;
use app\modules\admin\models\Extradition;
use app\modules\admin\models\Library_fund;
use app\modules\admin\models\Library_storage;
use app\modules\admin\models\Limits;
use app\modules\admin\models\Literature;
use app\modules\admin\models\Pensioner;
use app\modules\admin\models\Schoolchild;
use app\modules\admin\models\Scientist;
use app\modules\admin\models\Student;
use app\modules\admin\models\Teacher;
use app\modules\admin\models\Worker;


class ReqController extends controller
{

  // 1.	Получить список читателей с заданными характеристиками: студентов указанного учебного заведения, факультета, научных работников по определенной тематике и т.д.

  /* public function actionReq1() {
    $model = new Req1();

    $query = null;
       if (!$model->load(Yii::$app->request->post())) {
           $model->abonement = '%';
           $model->student = '%';
       }

      $q1 = abonement::find()
      ->leftJoin('student', "student.id_student = abonement.id_abonement")
      ->where(['like', 'student.university_s', $model->student, false])
      ->all();
           return $this->render('req1', [
               'q1' => $q1,
               'model' => $model,
           ]);
  } */

  public function actionReq1() {
    $model = new Req1();

    $query = null;
       if (!$model->load(Yii::$app->request->post())) {
           $model->student = '%';

       }
      $q1 = student::find()
        ->where(['like', 'student.university_s', $model->student, false])
        ->all();


           return $this->render('req1', [
               'q1' => $q1,
               'model' => $model,
           ]);
  }


// 2.	Выдать перечень читателей, на руках у которых находится указанное произведение

public function actionReq2() {
  $model = new Req2();

  $query = null;
       if (!$model->load(Yii::$app->request->post())) {
           $model->abonement = '%';
           $model->extradition = '%';
           $model->library_storage = '%';
       }
      $q2 = abonement::find()
      ->leftJoin('extradition', "extradition.id_ab = abonement.id_abonement")
      ->leftJoin('library_storage', "library_storage.num_nomen = extradition.num_nomenclatyre")
      ->where(['like', 'library_storage.title_ls', $model->abonement, false])
      ->andWhere(['is', 'extradition.date_return', null])
      ->all();

           return $this->render('req2', [
               'q2' => $q2,
               'model' => $model,
           ]);
/*  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->extradition = '%';
         $model->library_storage = '%';
     }
    $q2 = extradition::find()
    ->leftJoin('library_storage', "library_storage.num_nomen = extradition.num_nomenclatyre")
    ->where(['like', 'library_storage.title_ls', $model->extradition, false])
    ->andWhere(['is', 'extradition.date_return', null])
    ->all();

         return $this->render('req2', [
             'q2' => $q2,
             'model' => $model,
         ]);*/
}

// 3.	Получить список читателей, на руках у которых находится указанное издание (книга, журнал и т.д).

public function actionReq3() {
  $model = new Req3();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->extradition = '%';
         $model->abonement = '%';
         $model->library_storage = '%';
         $model->abonement = '%';
     }
    $q3 = abonement::find()
    ->leftJoin('extradition', "extradition.id_ab = abonement.id_abonement")
    ->leftJoin('library_storage', "library_storage.num_nomen = extradition.num_nomenclatyre")
    ->leftJoin('literature', "literature.id_literature = library_storage.id_literaryte")
    ->where(['like', 'literature.title_l', $model->abonement, false])
    ->andWhere(['is', 'extradition.date_return', null])
    ->all();

         return $this->render('req3', [
             'q3' => $q3,
             'model' => $model,
         ]);
}

// 4.	Получить перечень читателей, которые в течение указанного промежутка времени получали издание с некоторым произведением, и название этого издания

public function actionReq4() {
  $model = new Req4();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->extradition = '%';
         $model->abonement = '%';
         $model->library_storage = '%';

     }
     $q4 = abonement::find()
     ->leftJoin('extradition', "extradition.id_ab = abonement.id_abonement")
     ->leftJoin('library_storage', "library_storage.num_nomen = extradition.num_nomenclatyre")
     ->where(['between', 'date_issue', "2022-04-01", "2022-04-30",  $model->abonement, false])
     ->andWhere(['like', 'library_storage.title_ls', $model->abonement, false])

     ->all();

         return $this->render('req4', [
             'q4' => $q4,
             'model' => $model,
         ]);
}

// 5.	Выдать список изданий, которые в течение некоторого времени получал указанный читатель из фонда библиотеки, где он зарегистрирован.

public function actionReq5() {
  $model = new Req5();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->library_storage = '%';
         $model->literature = '%';
         $model->abonement = '%';
         $model->extradition = '%';
         $model->library_fund = '%';
}
         $q5 = literature::find()
         ->leftJoin('library_storage', "library_storage.id_literaryte = literature.id_literature")
         ->leftJoin('extradition', "extradition.num_nomenclatyre = library_storage.num_nomen")
         ->leftJoin('abonement', "abonement.id_abonement = extradition.id_ab")
         ->leftJoin('library_fund', "library_fund.id_libraryf = library_storage.id_library")
         ->where(['between', 'date_issue', "2022-04-01", "2022-05-01",  $model->literature, false])
         ->andWhere(['like', 'abonement.surname_ab', $model->literature, false])
         ->all();

         return $this->render('req5', [
             'q5' => $q5,
             'model' => $model,
         ]);
}

// 6.	Получить перечень изданий, которыми в течение некоторого времени пользовался указанный читатель из фонда библиотеки, где он не зарегистрирован.

public function actionReq6() {
  $model = new Req6();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->library_storage = '%';
         $model->literature = '%';
         $model->abonement = '%';
         $model->extradition = '%';
         $model->library_fund = '%';
}
         $q6 = literature::find()
         ->leftJoin('library_storage', "library_storage.id_literaryte = literature.id_literature")
         ->leftJoin('extradition', "extradition.num_nomenclatyre = library_storage.num_nomen")
         ->leftJoin('abonement', "abonement.id_abonement = extradition.id_ab")
         ->leftJoin('library_fund', "library_fund.id_libraryf = library_storage.id_library")
         ->where(['between', 'date_issue', "2022-04-01", "2022-05-01",  $model->literature, false])
         ->andWhere(['like', 'abonement.surname_ab', $model->literature, false])
         ->all();

         return $this->render('req6', [
             'q6' => $q6,
             'model' => $model,
         ]);
}

// 7.	Получить список литературы, которая в настоящий момент выдана с определенной полки некоторой библиотеки.

public function actionReq7() {
  $model = new Req7();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->library_storage = '%';
}
         $q7 = library_storage::find()->where(['like', 'library_storage.shelve', $model->library_storage, false])->all();

         return $this->render('req7', ['q7' => $q7, 'model' => $model,]);
}

// 8.	Выдать список читателей, которые в течение обозначенного периода были обслужены указанным библиотекарем.

public function actionReq8() {
  $model = new Req8();

   if ($model->load(Yii::$app->request->post())) {
        $q8 = abonement::find()
        ->leftJoin('extradition', "extradition.id_ab = abonement.id_abonement")
        ->leftJoin('employee', "employee.id_employee = extradition.id_emp")
        ->where(['like', 'employee.surname_e', $model->abonement, false])
         ->andWhere(['between', 'extradition.date_issue',   $model->abonement1,  $model->abonement2, false])

      //  ->where(['>', 'date_issue', $model->abonement])
      //  ->andWhere(['<', 'date_return', $model->abonement])
        ->all();
        } else {
          $q8 = abonement::find()
          ->all();
        }

/*
  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->abonement = '%';
         $model->extradition = '%';
         $model->employee = '%';
}
         $q8 = abonement::find()
         ->leftJoin('extradition', "extradition.id_ab = abonement.id_abonement")
         ->leftJoin('employee', "employee.id_employee = extradition.id_emp")
         ->where(['like', 'employee.surname_e', $model->abonement, false])
        ->andWhere(['between', 'extradition.date_issue',   $model->abonement1,  $model->abonement2, false])
         ->all();*/

         return $this->render('req8', [
             'q8' => $q8,
             'model' => $model,
         ]);
}

// 9.	Получить данные о выработке библиотекарей (число обслуженных читателей в указанный период времени).

public function actionReq9() {
  $model = new Req9();

      if ($model->load(Yii::$app->request->post())) {
      $q9 = extradition::find()
      ->select(['COUNT(num_nomenclatyre) AS cnt', 'id_emp'])
      ->where(['>', 'date_issue', $model->extradition])
      ->andWhere(['<', 'date_return', $model->extradition])
      ->groupBy('id_emp')->all();
      } else {
      $q9 = extradition::find()
      ->select(['COUNT(num_nomenclatyre) AS cnt', 'id_emp'])
      ->groupBy('id_emp')
      ->all();
    }

/*
public function actionReq9() {
  $model = new Req9();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->abonement = '%';
         $model->extradition = '%';
         $model->employee = '%';
}
         $q9 = extradition::find()
         ->select(['extradition.id_emp', 'COUNT(extradition.num_nomenclatyre) '])
         ->where(['between', 'date_issue', "2022-04-01", "2022-05-01",  $model->extradition, false])
         ->groupBy('extradition.id_emp')
         ->all();*/

         return $this->render('req9', [
             'q9' => $q9,
             'model' => $model,
         ]);
}

// 10.	Получить список читателей с просроченным сроком литературы.

public function actionReq10() {
  $model = new Req10();

      if ($model->load(Yii::$app->request->post())) {
      $q10 = extradition::find()
      ->leftJoin('abonement', "abonement.id_abonement = extradition.id_ab")
      ->where('DATEDIFF(`date_return`,`date_issue`)>30')
      ->andWhere(['like', 'abonement.surname_ab', $model->extradition])
      ->all();
      } else {
      $q10 = extradition::find()
      ->where('DATEDIFF(`date_return`,`date_issue`)>30')
      ->all();
      }
      return $this->render('req10', [
        'q10' => $q10,
        'model' => $model]);
}

// 11.	Получить перечень указанной литературы, которая поступила (была списана) в течение некоторого периода.

public function actionReq11() {
  $model = new Req11();

      if ($model->load(Yii::$app->request->post())) {
        $q11 = book::find()->where(['>=', 'date_issue', $model->book])->orWhere(['>=', 'date_return', $model->book])->all();
        } else {
        $q11 = book::find()->all();
        }

         return $this->render('req11', [
             'q11' => $q11,
             'model' => $model,
         ]);
}

// 12.	Выдать список библиотекарей, работающих в указанном читальном зале некоторой библиотеки.

public function actionReq12() {
  $model = new Req12();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->abonement = '%';
         $model->extradition = '%';
         $model->employee = '%';
}
         $q12 = employee::find()
         ->andWhere(['like', 'employee.id_roomread', $model->employee, false])
         ->all();

         return $this->render('req12', [
             'q12' => $q12,
             'model' => $model,
         ]);
}

// 13.	Получить список читателей, не посещавших библиотеку в течение указанного времени.

public function actionReq13() {
  $model = new Req13();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->abonement = '%';
         $model->extradition = '%';
         $model->employee = '%';
  }
        $q13 = abonement::find()
        ->leftJoin('extradition', "extradition.id_ab = abonement.id_abonement")
        ->where(['not like', 'date_issue',  $model->abonement, false])
        ->orWhere(['not like', 'date_return',  $model->abonement, false])
        ->all();

         return $this->render('req13', [
             'q13' => $q13,
             'model' => $model,
         ]);
}

// 14.	Получить список инвентарных номеров и названий из библиотечного фонда, в которых содержится указанное произведение.

public function actionReq14() {
  $model = new Req14();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->abonement = '%';
         $model->extradition = '%';
         $model->employee = '%';
         $model->library_storage = '%';
  }
        $q14 = library_storage::find()
        ->where(['like', 'library_storage.title_ls', $model->library_storage, false])
        ->all();

         return $this->render('req14', [
             'q14' => $q14,
             'model' => $model,
         ]);
}

// 15.	Выдать список инвентарных номеров и названий из библиотечного фонда, в которых содержатся произведения указанного автора.

public function actionReq15() {
  $model = new Req15();

  $query = null;
     if (!$model->load(Yii::$app->request->post())) {
         $model->abonement = '%';
         $model->extradition = '%';
         $model->employee = '%';
         $model->library_storage = '%';
  }
        $q15 = library_storage::find()
        ->where(['like', 'library_storage.id_a', $model->library_storage, false])
        ->all();

         return $this->render('req15', [
             'q15' => $q15,
             'model' => $model,
         ]);
}

// 16.	Получить список самых популярных произведений.

public function actionReq16() {
  $model = new Req16();

  if ($model->load(Yii::$app->request->post())) {
      $q16 = extradition::find()
      ->select(['COUNT(extradition.num_nomenclatyre) as cnt', 'extradition.num_nomenclatyre'])
      ->leftJoin('library_storage', "extradition.num_nomenclatyre = library_storage.num_nomen")
      ->where(['like', 'library_storage.title_ls', $model->extradition])
      ->groupBy('extradition.num_nomenclatyre')
      ->having('COUNT(extradition.num_nomenclatyre)>1')
      ->all();
      } else {
      $q16 = extradition::find()
      ->select(['COUNT(extradition.num_nomenclatyre) as cnt', 'extradition.num_nomenclatyre'])
      ->groupBy('extradition.num_nomenclatyre')
      ->having('COUNT(extradition.num_nomenclatyre)>1')
      ->all();
      }

         return $this->render('req16', [
             'q16' => $q16,
             'model' => $model,
         ]);
}


}
