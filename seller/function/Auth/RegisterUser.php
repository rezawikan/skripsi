<?php
session_start();
require_once '../../vendor/autoload.php';

use Emall\Auth\Authentication as Auth;
use Emall\Auth\Redirect;
use Emall\Database\Database;
use Emall\Email\Email;

$seller 	= new Auth;
$user 		= Database::getInstance();
$home_url = '../../../index.php'; // redirect link



if (isset($_POST['email'],
					$_POST['username'],
					$_POST['password'],
					$_POST['firstName'],
					$_POST['lastName'])
		) { // all fill

    $email      = $_POST['email'];
    $username   = $_POST['username'];
    $firstName  = $_POST['firstName'];
		$lastName   = $_POST['lastName'];
		$password   = $_POST['password'];
    $code       = $seller->generateRandomString(50);

		if ($seller->register($email, $username, $firstName, $lastName, $password, $code)) {

				$lastID = $user->lastID();
	      $seller->startBalance($lastID);
	      $key = base64_encode($lastID);
	      $id = $key;

        $message = "
          <!doctype html>
          <html>
            <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Simple Transactional Email</title>
              <style media='all' type='text/css'>
              @media all {
                .btn-primary table td:hover {
                  background-color: #34495e !important;
                }
                .btn-primary a:hover {
                  background-color: #34495e !important;
                  border-color: #34495e !important;
                }
              }

              @media all {
                .btn-secondary a:hover {
                  border-color: #34495e !important;
                  color: #34495e !important;
                }
              }

              @media only screen and (max-width: 620px) {
                table[class=body] h1 {
                  font-size: 28px !important;
                  margin-bottom: 10px !important;
                }
                table[class=body] h2 {
                  font-size: 22px !important;
                  margin-bottom: 10px !important;
                }
                table[class=body] h3 {
                  font-size: 16px !important;
                  margin-bottom: 10px !important;
                }
                table[class=body] p,
                table[class=body] ul,
                table[class=body] ol,
                table[class=body] td,
                table[class=body] span,
                table[class=body] a {
                  font-size: 16px !important;
                }
                table[class=body] .wrapper,
                table[class=body] .article {
                  padding: 10px !important;
                }
                table[class=body] .content {
                  padding: 0 !important;
                }
                table[class=body] .container {
                  padding: 0 !important;
                  width: 100% !important;
                }
                table[class=body] .header {
                  margin-bottom: 10px !important;
                }
                table[class=body] .main {
                  border-left-width: 0 !important;
                  border-radius: 0 !important;
                  border-right-width: 0 !important;
                }
                table[class=body] .btn table {
                  width: 100% !important;
                }
                table[class=body] .btn a {
                  width: 100% !important;
                }
                table[class=body] .img-responsive {
                  height: auto !important;
                  max-width: 100% !important;
                  width: auto !important;
                }
                table[class=body] .alert td {
                  border-radius: 0 !important;
                  padding: 10px !important;
                }
                table[class=body] .span-2,
                table[class=body] .span-3 {
                  max-width: none !important;
                  width: 100% !important;
                }
                table[class=body] .receipt {
                  width: 100% !important;
                }
              }

              @media all {
                .ExternalClass {
                  width: 100%;
                }
                .ExternalClass,
                .ExternalClass p,
                .ExternalClass span,
                .ExternalClass font,
                .ExternalClass td,
                .ExternalClass div {
                  line-height: 100%;
                }
                .apple-link a {
                  color: inherit !important;
                  font-family: inherit !important;
                  font-size: inherit !important;
                  font-weight: inherit !important;
                  line-height: inherit !important;
                  text-decoration: none !important;
                }
              }
              </style>
            </head>
            <body class=' style='font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f6f6f6; margin: 0; padding: 0;'>
              <table border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;' width='100%' bgcolor='#f6f6f6'>
                <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto !important; max-width: 580px; padding: 10px; width: 580px;' width='580' valign='top'>
                    <div class='content' style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>

                      <!-- START CENTERED WHITE CONTAINER -->
                      <span class='preheader' style='color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;'>Email confirmation for your account in Emall</span>
                      <table class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #fff; border-radius: 3px;' width='100%'>

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                            <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
                              <tr>
                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Hi $username,</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Thanks for join with us. Please activate your account by clicking the button below.</p>
                                  <table border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;' width='100%'>
                                    <tbody>
                                      <tr>
                                        <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;'>
                                            <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;' valign='top' bgcolor='#3498db' align='center'> <a href='http://localhost/skripsi/seller/verify.php?id=$id&code=$code' target='_blank' style='display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;'>Confirm Emall Account</a> </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>We may need to communicate important service level issues with you from time to time, so it's <strong>important we have an up-to-date email address</strong> for you on file.</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>Good luck! Hope it works.</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;'>The Emall Team</p>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                        </table>

                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; padding-top: 10px; text-align: center; width: 100%;'>
                        <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;' width='100%'>
                          <tr>
                            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-top: 10px; padding-bottom: 10px; font-size: 12px; color: #999999; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #999999; font-size: 12px; text-align: center;'>Company Inc, 3 Abbey Road, San Francisco CA 94102</span>
                              <br> Don't like these emails? <a href='http://i.imgur.com/CScmqnj.gif' style='text-decoration: underline; color: #999999; font-size: 12px; text-align: center;'>Unsubscribe</a>.
                            </td>
                          </tr>
                          <tr>
                            <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-top: 10px; padding-bottom: 10px; font-size: 12px; color: #999999; text-align: center;' valign='top' align='center'>
                              Powered by <a href='http://htmlemail.io' style='color: #999999; font-size: 12px; text-align: center; text-decoration: none;'>HTMLemail</a>.
                            </td>
                          </tr>
                        </table>
                      </div>

                      <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
                    </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                </tr>
              </table>
            </body>
          </html>
      ";

      	$subject = "Activate your Emall account to start selling";

      if (Email::sendMail($email,$message,$subject)) {
        	echo json_encode(array('status' => 'email berhasil terkirim','email' => $email, 'process' => 'success'));
      } else {
        	echo json_encode(array('status' => 'email gagal terkirim', 'process' => 'failed'));
      }
  } else {
      echo json_encode(array('error' => 'Failed to registration', 'process' => 'failed'));
  }
} else {
  	Redirect::to($home_url); // for direct acces to this file
}
