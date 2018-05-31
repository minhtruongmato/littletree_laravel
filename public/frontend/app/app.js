'use strict';

var app = angular.module('hamruouthinh24App', ['ng', 'ngRoute', 'ngResource', 'ngMaterial', 'ui.bootstrap', 'ngCookies', 'jkAngularRatingStars'], function($interpolateProvider, $locationProvider){
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');

    // enable HTML5mode to disable hashbang urls
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });
})
    // .run(function($rootScope) {
    //     $rootScope.countAddedProducts = 0;
    // })
    /* URL API */
    .constant('API_URL', 'http://localhost/hamruouthinh24/api/v1/')

    .filter('commaToDot', [function() {
        return function(string) {
            if (!angular.isString(string)) {
                return string;
            }
            return string.replace(/,/gi, '.');
        };
    }])

    .filter('removeUSCurrency', [function() {
        return function(string) {
            if (!angular.isString(string)) {
                return string;
            }
            return string.replace('$', ' ');
        };
    }])

    /* Build menu trademark and category of products */
    .factory('menuProductFactory', function($http, API_URL){
        return{
            menuProduct: function(){
                // Fetch trademark
                return $http({
                    method: 'GET',
                    url: API_URL + 'menu_product'
                });
            }
        }
    })

    .factory('productsFactory', function($http, API_URL){
        return{
            products: function(){
                // Fetch products
                return $http({
                    method: 'GET',
                    url: API_URL + 'products'
                });
            }
        }
    })
    .factory('listAdvisesFactory', function($http, API_URL){
        return{
            advises: function(){
                // Fetch advises
                return $http({
                    method: 'GET',
                    url: API_URL + 'advises'
                });
            }
        }
    })
    .factory('listNewsFactory', function($http, API_URL){
        return{
            news: function(){
                // Fetch news
                return $http({
                    method: 'GET',
                    url: API_URL + 'news'
                });
            }
        }
    })

    /* Directives */
    .directive('activeOnFirstItem', function(){
        return function(scope, element) {
            if (scope.$first) {
                element.addClass('active');
            }
        };
    })
    .directive('activeOnFirstFourItems', function(){
        return function(scope, element) {
            if (scope.$index === 0) {
                element.addClass('active');
            }
        };
    })
    .directive('numbersOnly', function() {
        return {
            require: 'ngModel',
            link: function(scope, element, attrs, modelCtrl) {
                modelCtrl.$parsers.push(function(inputValue) {
                    if (inputValue == undefined) return ''
                    var onlyNumeric = inputValue.replace(/[^0-9]/g, '');
                    if (onlyNumeric != inputValue) {
                        modelCtrl.$setViewValue(onlyNumeric);
                        modelCtrl.$render();
                    }
                    return onlyNumeric;
                });
            }
        };
    });