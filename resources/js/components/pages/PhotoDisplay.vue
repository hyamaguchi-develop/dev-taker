<template>
    <div id="app">
    <p id="error" v-show="error">{{ error }}</p>
    <!-- labelタグでimgタグとinputタグを囲めば、inputタグのクリック可能範囲を広げる -->

    <label>
        <p>クリックで画像を変更できます。</p>
        <img :src="avatar" alt="ここに画像が表示されます" class="image">
        <div>
        <p>タイトル：<input type="text" v-model="image_title" /></p>
        <!--  -->
        <input
            type="file"
            id="avatar_name"
            accept="image/jpeg, image/png"
            @change="onImageChange"
            v-if = "is_view"
            />
        </div>
    </label>
    <button @click="upload()">アップロード</button>
    <p>{{ message }}</p>
    <table border="1">
            <tr>
                <th>タイトル</th>
                <th>画像名</th>
                <th>画像</th>
            </tr>
            <tr v-for="image in images" :key="image.image_id">
                <td>{{ image.image_title }}</td>
                <!-- storage/切り捨て ※他のやり方もあると思われ -->
                <td>{{ image.image_path.substr(8, 99) }}</td>
                <td><img class="img" :src="`${image.image_path}`" /></td>
            </tr>
    </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
		data(){
			return {
                // defined on the instance
                avatar: '',
                // api通信後のメッセージ出力用
                message: '',
                // error文言出力用
                error: '',
                
                image_title:'',
                image_path:'',
                images:[],
                // ファイル名表示フラグ
                is_view : true,
            }
        },
    created: function() {
        this.getImage();
    },
        
    methods: {
        getImage() {
            var self = this;
            var url = '/api/images/'
            axios
                .get(url)
                .then(response => {
                    self.images = response.data.image;
                })
                .catch(err => {
                    self.message = err;
                });
        },
        /**
         * setError:アップロードが失敗したときの処理メソッド
         */
        setError (error, text) {
        this.error = (error.response && error.response.data && error.response.data.error) || text
        },
        /** 
         * Base64:データを文字列()として表す変換方式 
         * すべてのデータを英数字で表すMIME */
        getBase64 (file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader()
            reader.readAsDataURL(file)
            reader.onload = () => resolve(reader.result)
            reader.onerror = error => reject(error)
        })
        },
        onImageChange (e) {
        // 
        const files = e.target.files || e.dataTransfer.files
        // フォームから入力した値を保持
        this.image_path = files[0]
        this.getBase64(files[0])
            .then(image => this.avatar = image)
            .catch(error => this.setError(error, '画像のアップロードに失敗しました。'))
        },

        upload () {
            if (this.avatar) {
            //base64に変換した状態で画像があったときの処理
                
            /* TODO : postで画像を送る処理をここに書く */
            let data = new FormData()
            // data.append("dbカラム名, フォームから受け渡す値);
            data.append("image_title", this.image_title)
            data.append("image_path", this.image_path)

            var url = '/api/images/'

            axios.post(url, data)
            .then(response => {
                this.message ="登録に成功しました"
                
                this.is_view = false
                this.$nextTick(function () {
                    this.is_view = true;
                });
            //do not describe
            })
            .catch(err => {
                this.message = err
            });
            this.message = 'S3にでも保管するか。アップロード完了' 
            } else {
                //画像がなかったときの処理
                this.error = '画像がありません'
            }
        }
    }
}
        
</script>