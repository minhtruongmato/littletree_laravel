@extends('layouts.frontend-template')
@section('content')
    <link href="{{ asset("public/frontend/css/blog.css")}}" rel="stylesheet" type="text/css" />
    <section class="main_content" ng-controller="DetailBlogController">
        <!-- InstanceBeginEditable name="content" -->
        <div class="container">
            <div class="row">
                <div class="content col-md-9 col-sm-9 col-xs-12">
                    <article>
                        <h2><% selected.title %></h2>
                        <input type="hidden" value="<% selected.id %>" ng-model="id">
                        <blockquote>
                            <p ng-bind-html="$sce.trustAsHtml(selected.description)"></p>
                            {{--<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>--}}
                        </blockquote>

                        <p ng-bind-html="$sce.trustAsHtml(selected.content)"></p>

                    </article>

                    <div class="comments">
                        <form role="form" name="comment" ng-submit="save(selected.id)">
                            <div class="comments_post">
                                <h3>Bình luận</h3>

                                <div class="form-group">
                                    <label for="inputName">Họ tên</label>
                                    <input type="text" class="form-control" id="inputAuthor" placeholder="VD: Nguyễn Văn An" name="author" ng-model="author" ng-required="true">
                                    <span class="help-block" ng-show="comment.author.$error.required">Họ tên không được trống</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" ng-model="email" ng-required="true">
                                    <span class="help-block" ng-show="comment.email.$error.required">Email không được trống</span>
                                    <span class="help-block" ng-show="comment.email.$error.email">Định dạng email không đúng</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputMessage">Nội dung</label>
                                    <textarea class="form-control" id="inputMessage" placeholder="Viết cho chúng tôi cảm nhận của bạn" rows="4" name="content" ng-model="content" ng-required="true"></textarea>
                                    <span class="help-block" ng-show="comment.content.$error.required">Nội dung không được trống</span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit" id="sendComment" ng-disabled="comment.$invalid">Gửi đánh giá</button>
                                </div>
                            </div>
                        </form>

                        <div class="comments_posts_list">
                            <table class="table list-comment">
                                    <div class="media first-comment" ng-repeat="comments in blogComments">
                                        <div class="media-left">
                                            <img class="media-object" src="{{ asset('public/frontend/img/users_ava.png') }}" alt="users_ava">
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><% comments.author %></h4>
                                            <p ng-bind-html="$sce.trustAsHtml(comments.content)"></p>
                                        </div>
                                    </div>
                            </table>

                        </div>
                        <div class="btn btn-primary see-more" ng-click="seeMore(selected.id)">Xem thêm ...</div>
                    </div>

                </div>

                <div class="nav_side col-md-3 col-sm-3 col-xs-12">
                    <div class="panel panel-default">
                        <!-- Default panel contents -->
                        <div class="panel-heading">Bài viết <% title %></div>
                            <ul class="list-group">
                                <li class="list-group-item" ng-repeat="advise in advises" ng-hide="<% advise.slug == slug %>" ng-if="type == 0">
                                    <a href="{{ url('/tu-van') }}/<% advise.slug %>" target="_self"><% advise.title %></a>
                                </li>
                                <li class="list-group-item" ng-repeat="new in news" ng-hide="<% new.slug == slug %>" ng-if="type == 1">
                                    <a href="{{ url('/tin-tuc') }}/<% new.slug %>" target="_self"><% new.title %></a>
                                </li>
                            </ul>
                    </div>
                </div>

            </div>
        </div>
        <!-- InstanceEndEditable -->
    </section>
    <script src="{{ asset ("public/frontend/app/controllers/detail-blog.js") }}"></script>
    <script>
        $(window).scroll(function () {
            'use strict';
            if ($(window).scrollTop() > 150) {
                $('.main_content').css( 'margin-top' , '280px');
            }
            if ($(window).scrollTop() < 150) {
                $('.main_content').css( 'margin-top' , '50px');
            }
        });
        // $('#sendComment').click(function(){
        //     alert(1);
        //     return false;
        // })
    </script>
@endsection