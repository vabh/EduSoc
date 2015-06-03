<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

/*global routes*/
$route['default_controller'] = "main";
$route['404_override'] = '';
$route['signup'] = 'users/signup';
$route['logout'] = 'users/logout';
$route['login'] = 'users/login';
$route['profile'] = 'users/profile';
$route['profile/([a-zA-Z0-9]+)'] = 'users/profile/$1';
$route['edit'] = 'users/edit';
$route['password/change'] = 'users/changePassword';
$route['add/friend/([a-zA-Z0-9]+)'] = 'users/addFriend/$1';
$route['respondFriendReq/([a-zA-Z0-9]+)/([a-zA-Z0-9]+)'] = 'users/respondFriendReq/$1/$2';

/*instructor routes*/
$route['course/create'] = 'instructor/createCourse';
$route['course/continue/([a-zA-Z0-9_]+)'] = 'instructor/continueCourseCreation/$1';
$route['course/new/unit/([a-zA-Z0-9_]+)'] = 'instructor/newUnit/$1';
$route['course/new/chapter/([a-zA-Z0-9\-_]+)'] = 'instructor/newChapter/$1';
$route['course/new/page/([a-zA-Z0-9\-_]+)'] = 'instructor/newPage/$1';
$route['course/view/([a-zA-Z0-9\-_]+)'] = 'instructor/displayPage/$1';
$route['course/exam'] = 'instructor/createExam';
$route['course/exam/([a-zA-Z0-9\-_]+)'] = 'instructor/createExam/$1';


/*course routes*/
$route['course/catalog'] = 'student/signupCourse';
$route['course/study/([a-zA-Z0-9\-_]+)'] = 'student/signupCourse/$1';
$route['study/([a-zA-Z0-9\-_]+)'] = 'student/continueCourse/$1';
$route['study/page/([a-zA-Z0-9\-_]+)'] = 'student/viewPage/$1';
$route['exam/([a-zA-Z0-9_\-]+)'] = 'student/takeTest/$1';
$route['course/profile/([a-zA-Z0-9_\-]+)'] = 'main/courseProfile/$1';

/*forum routes*/
$route['forum/([a-zA-Z0-9_\-]+)'] = 'forum/viewForum/$1';
$route['forum/new/thread/([a-zA-Z0-9_\-]+)'] = 'forum/createThread/$1';
$route['forum/thread/([a-zA-Z0-9_\-]+)'] = 'forum/post/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */