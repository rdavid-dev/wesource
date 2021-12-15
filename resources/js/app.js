import {createApp} from 'vue'

require('./bootstrap')
import App from './App.vue'
import Api from './api'
import router from './router'

const app = createApp(App)

app.config.globalProperties.$api = Api;
app.use(router)
app.mount('#app')