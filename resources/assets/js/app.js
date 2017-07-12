


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('posts', require('./components/posts.vue'));
Vue.component('comments', require('./components/comments.vue'));
Vue.component('usercards', require('./components/usercards.vue'));

Vue.component('profile', require('./components/profile.vue'));

Vue.component('newpost', require('./components/newpost.vue'));

Vue.component('card', require('./components/Autonomous/card.vue'));
Vue.component('comment', require('./components/Autonomous/comment.vue'));

Vue.component('post', require('./components/post.vue'));

const app = new Vue({
    el: '#app',
    components: {
     }

});