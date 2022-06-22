<?php

use App\Controller\ExcursionController;
use App\Controller\UserController;
use App\Controller\OrderController;
use App\Controller\TagController;
use App\Controller\MessageController;
use App\Controller\ImageController;
use App\Lib\Router;

/** Публичная страница */

Router::add(
	"GET",
	"/",
	[ExcursionController::class, 'showTopExcursionsForPublicPageAction']
);

Router::add(
	"GET",
	"/allExcursions/",
	[ExcursionController::class, 'showAllExcursionsForPublicPageAction']
);

Router::add(
	"POST",
	"/sort",
	[ExcursionController::class, 'showSortedExcursionsForPublicPageAction']
);

Router::add(
	"GET",
	"/excursion/:excursionId",
	[ExcursionController::class, 'showExcursionByIdForPublicPageAction']
);

Router::add(
	"GET",
	"/allExcursions/excursion/:excursionId",
	[ExcursionController::class, 'showExcursionByIdForPublicPageAction']
);

Router::add(
	"POST",
	"/allExcursions/found",
	[ExcursionController::class, 'showFoundBySearchExcursionsForPublicPageAction']
);

Router::add(
	"POST",
	"/createOrder",
	[OrderController::class, 'createOrder']
);



/** Админская страница */

Router::add(
	"GET",
	"/login",
	[UserController::class, 'loginUser']
);

Router::add(
	"GET",
	"/logout",
	[UserController::class, 'logOutUser']
);

Router::add(
	"POST",
	"/admin/excursions",
	[UserController::class, 'Authorized']
);

Router::add(
	"POST",
	"/admin/excursions/saved",
	[ExcursionController::class, 'editExcursion']
);

Router::add(
	"GET",
	"/admin/excursions",
	[ExcursionController::class, 'showAdminExcursionList']
);

Router::add(
	"GET",
	"/admin",
	[UserController::class, 'adminPanel']
);

Router::add(
	"GET",
	"/admin/detailed?id=:id",
	[ExcursionController::class, 'showAdminExcursionById']

);

Router::add(
	"GET",
	"/admin/orders",
	[OrderController::class, 'showAdminOrders']
);

Router::add(
	"POST",
	"/admin/orders/saved",
	[OrderController::class, 'editOrder']
);

Router::add(
	"POST",
	"/admin/orders/deleted",
	[OrderController::class, 'deleteOrder']
);

Router::add(
	"POST",
	"/admin/orders/find",
	[OrderController::class, 'findOrdersByClientName']
);

Router::add(
	"GET",
	"/admin/tags",
	[TagController::class, 'showAdminTags']
);

Router::add(
	"POST",
	"/admin/excursions/addDate",
	[ExcursionController::class, 'addExcursionDate']
);

Router::add(
	"GET",
	"/admin/excursion/add",
	[ExcursionController::class, 'addExcursion']
);

Router::add(
	"POST",
	"/admin/tag/deleted?id=:id",
	[TagController::class, 'deleteTag']
);

Router::add(
	"POST",
	"/admin/typeTag/deleted?id=:id",
	[TagController::class, 'deleteTypeTag']
);

Router::add(
	"POST",
	"/admin/tag/saved",
	[TagController::class, 'saveTag']
);

Router::add(
	"POST",
	"/admin/tag/created",
	[TagController::class, 'addTag']
);

Router::add(
	"POST",
	"/admin/typeTag/created",
	[TagController::class, 'addTypeTag']
);

Router::add(
	"POST",
	"/admin/typeTag/saved",
	[TagController::class, 'saveTypeTag']
);

Router::add(
	"GET",
	"/about",
	[MessageController::class, 'showStaffInformationAction']
);

Router::add(
	"GET",
	"/client",
	[MessageController::class, 'showCommonInformationAction']
);

Router::add(
	"GET",
	"/blog",
	[MessageController::class, 'showBlogAction']
);

Router::add(
	"POST",
	"/admin/excursion/create",
	[ExcursionController::class, 'createExcursion']
);

Router::add(
	"POST",
	"/admin/excursion/found",
	[ExcursionController::class, 'showAdminExcursionListBySearch']
);

Router::add(
	"POST",
	"/admin/excursions/deleteDate",
	[ExcursionController::class, 'deleteExcursionDate']
);

Router::add(
	"GET",
	"/allExcursions/?order=:order",
	[ExcursionController::class, 'showAllExcursionsForPublicPageAction']
);

Router::add(
	"GET",
	"/admin/userChange/show",
	[UserController::class, 'showUserAction']
);

Router::add(
	"POST",
	"/admin/userChange/saved",
	[UserController::class, 'changeUserPasswordAction']
);

Router::add(
	"POST",
	"/admin/imageUpload",
	[ImageController::class, 'imageUploadAction']
);

Router::add(
	"POST",
	"/admin/imageDelete",
	[ImageController::class, 'imageDeleteAction']
);