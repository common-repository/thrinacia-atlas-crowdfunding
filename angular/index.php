<!DOCTYPE html><html id="ng-app" ng-app="Atlas"><head><base href="/<?php $path = explode('/', $_SERVER['REQUEST_URI']); echo $path[1];?>/"><title ng-bind="page_title"></title><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="fragment" content="!"><meta property="fb:app_id" content="{{facebook_app_id}}" ng-if="facebook_app_id"><meta property="og:url" content="{{ogMeta.url}}"><meta property="og:type" content="website"><meta property="og:title" content="{{ogMeta.title}}"><meta property="og:description" content="{{ogMeta.description}}"><meta property="og:site_name" content="{{ogMeta.site_name}}"><meta property="og:image" content="{{ogMeta.image}}" ng-if="ogMeta.image"><meta http-equiv="Pragma" content="no-cache"><meta http-equiv="Expires" content="-1"><link ng-controller="FavIconCtrl" rel="shortcut icon" ng-href="{{faviconURL}}" type="image/png"><link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700|Pacifico|Lato:400,700,400italic,700italic&subset=latin" rel="stylesheet" type="text/css"><link rel="stylesheet" href="app/bower_components/semantic-ui/dist/semantic.min.css"><link rel="stylesheet" href="app/bower_components/font-awesome/css/font-awesome.min.css"><link rel="stylesheet" href="stylesheets/screen.93636f7f.css" media="screen, projection"><link rel="stylesheet" href="app/bower_components/ngQuickDate/dist/ng-quick-date.css"><link rel="stylesheet" href="app/bower_components/select2/select2.css"><link rel="stylesheet" href="app/bower_components/angular-ui-select/dist/select.min.css"><link rel="stylesheet" href="stylesheets/pgwslider.93636f7f.css"><link rel="stylesheet" href="stylesheets/custom-pages.93636f7f.css"><link rel="stylesheet" href="custom/custom.css"><script src="app/bower_components/jquery/dist/jquery.min.js"></script><script src="https://www.youtube.com/player_api"></script><script src="app/bower_components/angular/angular.min.js"></script><script src="app/bower_components/angular-translate/angular-translate.min.js"></script><link rel="stylesheet" type="text/css" href="plugins/codemirror/codemirror.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/froala_editor.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/froala_style.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/char_counter.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/code_view.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/colors.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/draggable.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/emoticons.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/file.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/fullscreen.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/image.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/image_manager.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/line_breaker.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/quick_insert.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/table.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="plugins/froala/css/plugins/video.min.93636f7f.css"><link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css"><script src="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script></head><body ng-controller="MainCtrl" class="container main-color" id="{{$root.page_route}}" ng-class="theme_classes" translate-cloak ng-cloak><div class="unsupported" ng-if="isFacebookApp()"><p translate>unsupported_browser_message</p><p>{{location}}</p></div><div id="loader" class="ui page dimmer"><div class="content"><div class="center"><i ng-if="site_load_icon.path_external" class="custom-image icon loading"><img ng-src="{{server + '/image/w-100-h-100/' + site_load_icon.path_external}}" imageonload> </i><i ng-if="!site_load_icon.path_external" ng-class="site_load_class" class="icon loading massive"></i></div></div></div><div class="ui sidebar left vertical overlay inverted menu" id="mobile-sidebar" ng-controller="NavbarCtrl"><a class="item close-icon" ng-cloak><i class="close-menu remove icon" ng-click="closeMobileSidebar();"></i> </a><a href="{{site_logo_link}}" class="item" id="logo" ng-cloak><div class="logo-wrap"><img class="ui image" ng-src="{{logoUrl}}"></div></a><a ng-class="{active: $location.path() == '/' + page.path}" class="item menu-item" ng-repeat="page in headerMenu" ng-href="{{page.path}}" my-target="{{page.id}}" ng-bind="page.name" target="_self"></a><div ng-show="User.isLoggedIn()"><h4 class="ui horizontal header divider inverted mobile-menu-header" translate><i class="dashboard icon"></i> mobile_header_dashboard</h4><div class="menu"><a ng-if="User.portal_admin" class="item menu-item" ng-click="navItem()" ng-class="{active: $location.path() === '/admin/dashboard' && $location.hash() !== 'subscription-settings'}" href="/admin/dashboard/" translate>mobile_header_administration </a><a ng-if="User.campaign_manager" class="item menu-item" ng-class="{active: $location.path() === '/campaign-manager'}" href="/campaign-manager" translate>mobile_header_mycampaigns </a><a ng-if="User.campaign_backer" class="item menu-item" ng-class="{active: $location.path() === '/pledge-history'}" href="/pledge-history" translate>mobile_header_mycontributions </a><a class="item menu-item" class="item menu-item" ng-class="{active: $location.path() === 'message-center'}" href="/message-center" translate>mobile_header_mymessages</a></div><h4 class="ui horizontal header divider inverted mobile-menu-header" translate><i class="user icon"></i> mobile_header_personalsettings</h4><div class="menu"><a class="item menu-item" ng-class="{active: $location.path() === '/profile-setting'}" href="/profile-setting" translate>mobile_header_profilesettings </a><a class="item menu-item" ng-class="{active: $location.path() === '/payment-setting'}" href="/payment-setting" translate>mobile_header_paymentsettings</a></div><a class="item menu-item" ng-click="User.setLoggedOut()" translate>mobile_header_logout</a></div><a href="login" ng-if="!User.isLoggedIn()" class="item menu-item collapsible" translate>mobile_header_login</a></div><div class="pusher" style="overflow:initial" ng-show="partsDone"><script></script><div id="nav-wrapper" ng-include src="'views/templates/partials/nav.93636f7f.html'" ng-hide="$root.nav_disabled"></div><div id="main-bg" ng-view autoscroll="true" ng-class="{ 'sticky-menu-push' : stickyMenu }"></div><div id="footer-wrapper" ng-include src="'views/templates/partials/footer.93636f7f.html'" id="site-footer" ng-show="checkhome||checkstart||checkexplore||checkpledgehistory||checkCstatus||checkmessage||checkperson||checkSaccount||checklogin||checkapi||checkfooter" ng-if="!$root.footer_disabled"></div></div><a href id="back-to-top" ng-click="backToTop()"><i class="large circular inverted double angle up icon"></i></a><div class="loader-modal" id="myloader"></div><div ng-controller="AnalyticsCtrl" ng-bind-html="analyticsCode"></div><script src="app/bower_components/jquery-ui/jquery-ui.min.js"></script><script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script><script src="scripts/app.93636f7f.js"></script><script src="app_local.js"></script><script src="scripts/locale/locale-translator.93636f7f.js"></script><script src="plugins/spinjs/spin.min.93636f7f.js"></script><script src="scripts/API.93636f7f.js"></script><script src="scripts/directives/directives.93636f7f.js"></script><script src="scripts/controllers/app-config.93636f7f.js"></script><script src="scripts/controllers/HomeCtrl.93636f7f.js"></script><script src="scripts/controllers/UserProfileCtrl.93636f7f.js"></script><script src="scripts/controllers/ProfileCtrl.93636f7f.js"></script><script src="scripts/controllers/ResetPasswordCtrl.93636f7f.js"></script><script src="scripts/controllers/ConfirmEmailCtrl.93636f7f.js"></script><script src="scripts/controllers/RetryCardCtrl.93636f7f.js"></script><script src="scripts/controllers/RegisterCtrl.93636f7f.js"></script><script src="scripts/controllers/LoginCtrl.93636f7f.js"></script><script src="scripts/controllers/CreateCampaignCtrl.93636f7f.js"></script><script src="scripts/controllers/CompleteFundingCtrl.93636f7f.js"></script><script src="scripts/controllers/ContactMessageCtrl.93636f7f.js"></script><script src="scripts/controllers/CampaignCtrl.93636f7f.js"></script><script src="scripts/controllers/CampaignStatusCtrl.93636f7f.js"></script><script src="scripts/controllers/NavbarCtrl.93636f7f.js"></script><script src="scripts/controllers/FooterCtrl.93636f7f.js"></script><script src="scripts/controllers/CampaignStepCtrl.93636f7f.js"></script><script src="scripts/controllers/CustomPageCtrl.93636f7f.js"></script><script src="scripts/controllers/ApiDocsCtrl.93636f7f.js"></script><script src="scripts/controllers/UserManagementCtrl.93636f7f.js"></script><script src="scripts/controllers/PortalSettingCtrl.93636f7f.js"></script><script src="scripts/controllers/CampaignReviewCtrl.93636f7f.js"></script><script src="scripts/controllers/ExploreCtrl.93636f7f.js"></script><script src="scripts/controllers/PledgeHistoryCtrl.93636f7f.js"></script><script src="scripts/controllers/CampaignManagementCtrl.93636f7f.js"></script><script src="scripts/controllers/NavSearchCtrl.93636f7f.js"></script><script src="scripts/controllers/PledgeCampaignCtrl.93636f7f.js"></script><script src="scripts/controllers/CampaignPreviewCtrl.93636f7f.js"></script><script src="scripts/controllers/StartCtrl.93636f7f.js"></script><script src="scripts/controllers/ProfileSettingCtrl.93636f7f.js"></script><script src="scripts/controllers/PaymentSettingCtrl.93636f7f.js"></script><script src="scripts/controllers/SystemMessageCtrl.93636f7f.js"></script><script src="scripts/controllers/StripeConnectCtrl.93636f7f.js"></script><script src="scripts/controllers/MessageCenterCtrl.93636f7f.js"></script><script src="scripts/controllers/CreditCardFormCtrl.93636f7f.js"></script><script src="scripts/controllers/StreamManageCtrl.93636f7f.js"></script><script src="scripts/controllers/TransactionDetailsCtrl.93636f7f.js"></script><script src="scripts/controllers/WpListCtrl.93636f7f.js"></script><script src="scripts/controllers/WPCtrl.93636f7f.js"></script><script src="scripts/controllers/AccountCtrl.93636f7f.js"></script><script src="scripts/controllers/AnalyticsCtrl.93636f7f.js"></script><script src="scripts/controllers/InlineContributionCtrl.93636f7f.js"></script><script src="scripts/controllers/GuestCampaignCtrl.93636f7f.js"></script><script src="scripts/controllers/EmbedViewsCtrl.93636f7f.js"></script><script src="scripts/controllers/AdminReportCtrl.93636f7f.js"></script><script src="scripts/controllers/AdminUserManagementCtrl.93636f7f.js"></script><script src="scripts/controllers/AdminCategoryManagementCtrl.93636f7f.js"></script><script src="scripts/controllers/AdminCampaignManagementCtrl.93636f7f.js"></script><script src="scripts/controllers/AdminPageManagementCtrl.93636f7f.js"></script><script src="scripts/controllers/AdminPortalSettingsCtrl.93636f7f.js"></script><script src="scripts/controllers/WidgetCtrl.93636f7f.js"></script><script src="scripts/services/UserService.93636f7f.js"></script><script src="scripts/services/CreateCampaignService.93636f7f.js"></script><script src="scripts/services/StripeService.93636f7f.js"></script><script src="scripts/services/CoreService.93636f7f.js"></script><script src="scripts/services/VideoLinkService.93636f7f.js"></script><script src="scripts/services/CampaignSettingsService.93636f7f.js"></script><script src="scripts/services/PortalSettingsService.93636f7f.js"></script><script src="scripts/services/WpService.93636f7f.js"></script><script src="scripts/services/TwitterWidgetService.93636f7f.js"></script><script src="scripts/services/CurrencyService.93636f7f.js"></script><script src="scripts/services/FileUploadService.93636f7f.js"></script><script src="scripts/services/TimeStatusService.93636f7f.js"></script><script src="scripts/services/ValidateURLService.93636f7f.js"></script><script src="scripts/services/ThemeService.93636f7f.js"></script><script src="scripts/money_symbols.93636f7f.js"></script><script src="scripts/pgwslider.min.93636f7f.js"></script><script src="plugins/jscolor/jscolor.min.93636f7f.js"></script><script src="app/bower_components/angular-translate-loader-partial/angular-translate-loader-partial.min.js"></script><script src="app/bower_components/angular-translate-loader-url/angular-translate-loader-url.min.js"></script><script src="app/bower_components/angular-cookie/angular-cookie.min.js"></script><script src="app/bower_components/ng-csv/build/ng-csv.min.js"></script><script src="app/bower_components/ng-file-upload/angular-file-upload-shim.min.js"></script><script src="app/bower_components/ng-file-upload/angular-file-upload.min.js"></script><script src="app/bower_components/angular-route/angular-route.min.js"></script><script src="app/bower_components/angular-resource/angular-resource.min.js"></script><script src="app/bower_components/angular-cookie/angular-cookie.min.js"></script><script src="app/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script><script src="app/bower_components/angular-ui-sortable/sortable.min.js"></script><script src="app/bower_components/select2/select2.min.js"></script><script src="app/bower_components/angular-ui-select/dist/select.min.js"></script><script src="app/bower_components/angular-ui-select2/src/select2.js"></script><script src="app/bower_components/lodash/dist/lodash.min.js"></script><script src="app/bower_components/restangular/dist/restangular.min.js"></script><script src="app/bower_components/ngQuickDate/dist/ng-quick-date.min.js"></script><script src="app/bower_components/flow.js/dist/flow.min.js"></script><script src="app/bower_components/ng-flow/dist/ng-flow.min.js"></script><script src="app/bower_components/moment/min/moment.min.js"></script><script src="app/bower_components/angular-moment/angular-moment.js"></script><script src="app/bower_components/moment-timezone/builds/moment-timezone-with-data.min.js"></script><script src="app/bower_components/ng-videosharing-embed/build/ng-videosharing-embed.min.js"></script><script src="app/bower_components/angulartics/dist/angulartics.min.js"></script><script src="app/bower_components/angulartics/dist/angulartics-piwik.min.js"></script><script src="app/bower_components/angulartics/dist/angulartics-ga.min.js"></script><script src="plugins/auto_fill/autofill-event.min.93636f7f.js"></script><script src="plugins/currencies/map.93636f7f.js"></script><script src="plugins/currencies/currency-symbol-map.93636f7f.js"></script><script src="plugins/chartjs/Chart.min.93636f7f.js"></script><script src="plugins/chartjs/angles.min.93636f7f.js"></script><script src="app/bower_components/ng-clip-master/dest/ng-clip.min.js"></script><script src="app/bower_components/semantic-ui/dist/semantic.min.js"></script><script type="text/javascript" src="app/bower_components/jquery.payment/lib/jquery.payment.js"></script><script src="custom/custom.js"></script><script src="scripts/social-message.93636f7f.js"></script><script src="scripts/jquery_price_format.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/froala_editor.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/align.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/char_counter.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/code_beautifier.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/code_view.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/colors.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/draggable.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/emoticons.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/entities.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/file.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/font_family.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/font_size.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/forms.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/fullscreen.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/image.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/image_manager.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/inline_style.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/line_breaker.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/link.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/lists.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/paragraph_format.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/paragraph_style.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/quote.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/save.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/table.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/url.min.93636f7f.js"></script><script type="text/javascript" src="plugins/froala/js/plugins/video.min.93636f7f.js"></script><script type="text/javascript" src="plugins/codemirror/codemirror.min.93636f7f.js"></script><script type="text/javascript" src="plugins/codemirror/simple.min.93636f7f.js"></script><script type="text/javascript" src="plugins/codemirror/mode/css.min.93636f7f.js"></script><script type="text/javascript" src="plugins/codemirror/mode/xml.min.93636f7f.js"></script><script type="text/javascript" src="plugins/codemirror/mode/javascript.min.93636f7f.js"></script><script type="text/javascript" src="plugins/codemirror/mode/htmlmixed.min.93636f7f.js"></script><script src="https://js.stripe.com/v3/"></script><script type="text/javascript" src="app/bower_components/angular-froala/src/angular-froala.js"></script><script type="text/javascript" src="app/bower_components/angular-froala/src/froala-sanitize.js"></script><script>$.FroalaEditor.DEFAULTS.key = 'EKF1KXDA1INBc1KPc1TK==';</script></body></html>