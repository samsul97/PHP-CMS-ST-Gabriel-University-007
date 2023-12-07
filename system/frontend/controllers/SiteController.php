<?php
namespace frontend\controllers;

use backend\models\Contacts;
use backend\models\Seo;
use backend\models\VisitorLog;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Enquiry;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $contactUs = Contacts::findOne(['code' => 'STGABRIELPREUNIVERSITY']);

        $seoData = Seo::findByControllerAndView('site', 'index');

        $schemaProperties = isset($seoData->schema_properties) ? json_decode($seoData->schema_properties) : null;

        $name = isset($schemaProperties) && isset($schemaProperties->name) ? $schemaProperties->name : null;
        $description = isset($schemaProperties) && isset($schemaProperties->description) ? $schemaProperties->description : null;
        $url = isset($schemaProperties) && isset($schemaProperties->url) ? $schemaProperties->url : null;
        $image = isset($schemaProperties) && isset($schemaProperties->image) ? $schemaProperties->image : null;
        $datePublished = isset($schemaProperties) && isset($schemaProperties->datePublished) ? $schemaProperties->datePublished : null;
        $dateModified = isset($schemaProperties) && isset($schemaProperties->dateModified) ? $schemaProperties->dateModified : null;
        $authorName = isset($schemaProperties) && isset($schemaProperties->author->name) ? $schemaProperties->author->name : null;
        $publisherName = isset($schemaProperties) && isset($schemaProperties->publisher->name) ? $schemaProperties->publisher->name : null;
        $publisherLogo = isset($schemaProperties) && isset($schemaProperties->publisher->logo->url) ? $schemaProperties->publisher->logo->url : null;
        $keywords = isset($schemaProperties) && isset($schemaProperties->keywords) ? $schemaProperties->keywords : null;
        $mainEntityOfPage = isset($schemaProperties) && isset($schemaProperties->mainEntityOfPage) ? $schemaProperties->mainEntityOfPage : null;

        $ipAddress = Yii::$app->request->userIP;
        // $uniqueIdentifier = md5($ipAddress);

        $userAgent = Yii::$app->request->userAgent;

        if (preg_match('/MSIE|Trident/i', $userAgent)) {
            $browser = 'Internet Explorer';
        } elseif (preg_match('/Firefox/i', $userAgent)) {
            $browser = 'Firefox';
        } elseif (preg_match('/Chrome/i', $userAgent)) {
            $browser = 'Chrome';
        } else {
            $browser = 'Unknown';
        }

        if (preg_match('/Windows/i', $userAgent)) {
            $os = 'Windows';
        } elseif (preg_match('/Mac OS X/i', $userAgent)) {
            $os = 'Mac OS X';
        } elseif (preg_match('/Android/i', $userAgent)) {
            $os = 'Android';
        } elseif (preg_match('/iPhone/i', $userAgent)) {
            $os = 'iPhone';
        } else {
            $os = 'Unknown';
        }

        // $geoLocation = Yii::$app->geoip->getLocation($ipAddress);
        $language = Yii::$app->language;
        $referrer = Yii::$app->request->referrer;
        $currentUrl = Url::to('', true);
        $visitTime = date('Y-m-d H:i:s');

        return $this->render('index', [
            'contactUs' => $contactUs,
            'seoData' => $seoData,
            'name' => $name,
            'description' => $description,
            'url' => $url,
            'image' => $image,
            'datePublished' => $datePublished,
            'dateModified' => $dateModified,
            'authorName' => $authorName,
            'publisherName' => $publisherName,
            'publisherLogo' => $publisherLogo,
            'keywords' => $keywords,
            'mainEntityOfPage' => $mainEntityOfPage,
            'ipAddress' => $ipAddress,
            // 'uniqueIdentifier' => $uniqueIdentifier,
            'browser' => $browser,
            'os' => $os,
            // 'geoLocation' => $geoLocation,
            'language' => $language,
            'referrer' => $referrer,
            'currentUrl' => $currentUrl,
            'visitTime' => $visitTime,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionSendEnquiry() {
        $model = new Enquiry();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $name = $model->name;
            $subject = $model->subject;
            $email = $model->email;
            $message = $model->message;
            $to = 'forwarder@stgabrielpreuniversity.com';
            $model->save(false);

            $mailer = Yii::$app->mailer->compose()
                ->setFrom($email)
                ->setTo($to)
                ->setSubject($subject)
                ->setTextBody($message)
                ->send();
                
            if ($mailer) {
                Yii::$app->getSession()->setFlash('send_email_success', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Application sent!',
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to send message!');
            }
            return $this->redirect(['index']);

        }
    }

    public function actionSitemap()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        $urls = [
            ['loc' => Url::to(['site/index'], true)],
            ['loc' => Url::to(['about-us/profile'], true)],
            ['loc' => Url::to(['about-us/lecturer'], true)],
            ['loc' => Url::to(['about-us/ceomessage'], true)],
            ['loc' => Url::to(['about-us/programs'], true)],
            ['loc' => Url::to(['about-us/contact'], true)],
            ['loc' => Url::to(['article/articles'], true)],
            ['loc' => Url::to(['article/article-one'], true)],
            ['loc' => Url::to(['gallery/gallery-categories'], true)],
            ['loc' => Url::to(['gallery/gallery'], true)],
            ['loc' => Url::to(['gallery/gallery-detail'], true)],
            ['loc' => Url::to(['partners/partners'], true)],
            ['loc' => Url::to(['student/why-stgabriel'], true)],
            ['loc' => Url::to(['student/scs'], true)],
            ['loc' => Url::to(['student/alumni'], true)],
            ['loc' => Url::to(['student/pastoral-conseling'], true)],
            ['loc' => Url::to(['student/handbook'], true)],
            ['loc' => Url::to(['testimonys/testimonys'], true)],
        ];

        return [
            'urlset' => $urls,
        ];
    }

    public function actionTrackVisitor()
    {
        $request = Yii::$app->request;

        // $uniqueIdentifier = $request->post('unique_identifier');
        $ipAddress = $request->post('ip_address');
        $browser = $request->post('browser');
        $os = $request->post('os');
        // $geoLocation = $request->post('geo_location');
        $language = $request->post('language');
        $referrer = $request->post('referrer');
        $visitUrl = $request->post('current_url');
        $visitTime = $request->post('visit_time');

        $visitorLog = new VisitorLog([
            // 'unique_visitor_identifier' => $uniqueIdentifier,
            'ip_address' => $ipAddress,
            'browser' => $browser,
            'os' => $os,
            // 'geo_location' => $geoLocation,
            'language' => $language,
            'referrer' => $referrer,
            'visit_url' => $visitUrl,
            'visit_time' => $visitTime,
        ]);
        
        if ($visitorLog->save()) {
            return 'Tracking data received successfully';
        } else {
            return 'Error: ' . json_encode($visitorLog->errors);
        }
    }
}
