import Router from 'vue-router'
import Admin from './components/Admin.vue'
import Place from './components/pages/Place.vue'
import PhotoDisplay from './components/pages/PhotoDisplay.vue'

export default new Router({
  mode: 'history',
  
  routes: [
    {
      path: '/admin',
      name: 'admin',
      component: Admin
    },
    // 撮影情報の記録
    {
      path: '/place',
      name: 'place',
      component: Place
    },
    // 写真登録
    {
      path: '/photo-display',
      name: 'photo-display',
      component: PhotoDisplay
    },
  ]
});