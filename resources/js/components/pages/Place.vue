<template slot="items" slot-scope="props">
	<div id="app">
		<v-data-table
         :headers="headers"
         :items="photoInfo"
    	>
		<!-- 削除機能追加 -->
		<template v-slot:[`item.delete`]="{ item }">
			<v-btn
			small
			color="error"
			@click="deleteItem(item)"
			>
			delete
			</v-btn>
        </template>
		</v-data-table>
		<v-card>
			<v-card-text>
				<!-- 登録項目の追加箇所 -->
				<!--  -->
				<v-container>
					<v-row>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.photo_id"
							label="写真ID※自動で割り振られます"
							readonly
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.shooting_location"
							label="撮影場所"
							></v-text-field>
						</v-col>
						<!-- ToDo  セレクトボックスに変更予定-->
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-select
							:items="prefecture"
							v-model="editedItem.prefecture"
							label="都道府県"
							></v-select>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.iso"
							label="ISO感度"
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.f_value"
							label="F値"
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.shutter_speed"
							label="シャッター速度"
							></v-text-field>
						</v-col>
						<!-- 朝・昼・夕・夜のプルダウン -->
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-select
							:items="time_zone_item"
							v-model="editedItem.time_zone"
							label="時間帯"
							></v-select>
						</v-col>
						<!-- フラグ０・１で管理 -->
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.is_tripod"
							label="三脚有無"
							></v-text-field>
						</v-col>
						<v-col
							cols="12"
							sm="6"
							md="4"
							>
							<v-text-field
							v-model="editedItem.other"
							label="備考"
							></v-text-field>
						</v-col>
					</v-row>
				</v-container>
			</v-card-text>

		<!-- 入力情報を登録する -->
			<v-card-actions>
				<v-spacer></v-spacer>
				<v-btn
				color="blue darken-1"
				text
				@click="close"
				>
				Cancel
				</v-btn>
				<v-btn
				color="blue darken-1"
				text
				@click="save"
				>
				Save
				</v-btn>
			</v-card-actions>
		</v-card>
		<button v-on:click="downloadCSV">
		CSVダウンロード
		</button>
	</div>
	
</template>

<script>
import axios from 'axios';

export default {
		data(){
			return{
				headers: [
					{ text: '写真ID', align: 'center', value: 'photo_id' },
					{ text: '撮影場所', align: 'center', value: 'shooting_location' },
					{ text: '都道府県', align: 'center', value: 'prefecture' },
					{ text: 'ISO感度', align: 'center', value: 'iso'},
					{ text: 'F値', align: 'center', value: 'f_value'},
					{ text: 'シャッター速度', align: 'center', value: 'shutter_speed'},
					{ text: '時間帯', align: 'center', value: 'time_zone'},
					{ text: '三脚有無', align: 'center', value: 'is_tripod'},
					{ text: '備考', align: 'center', value: 'other'},
					// 削除行追加
					{
						text:'削除',
						value:'delete',
						sortable:false
					}
      			],
				// 写真情報格納用
				photoInfo:[],

				editedItem: {
					// default値を設定可能
				},
				/* 
					TODO - データベースに保管予定項目
				**/
				// time_zone項目追加
				time_zone_item: ['早朝', '朝', '昼', '夕','夜'],
				// 都道府県項目追加
				
				prefecture: [
					"北海道","青森県","岩手県","宮城県",
					"秋田県","山形県","福島県","茨城県",
					"栃木県","群馬県","埼玉県","千葉県",
					"東京都","神奈川県","新潟県","富山県",
					"石川県","福井県","山梨県","長野県",
					"岐阜県","静岡県","愛知県","三重県",
					"滋賀県","京都府","大阪府","兵庫県",
					"奈良県","和歌山県","鳥取県","島根県",
					"岡山県","広島県","山口県","徳島県",
					"香川県","愛媛県","高知県","福岡県",
					"佐賀県","長崎県","熊本県","大分県",
					"宮崎県","鹿児島県","沖縄県",
				],
			}
		},
		/*
		computed
			算出プロパティー
		*/
		computed: {

		},
		created(){
			/* 
			  ①api/photoInfoでアクセスした際にjson形式でとれる
			  ②responseされた情報をphotoInfoに積める
			  ③api.phpでjsonデータを引っ張ってくる.
			*/
			var self = this;
			var url = '/api/photoInfo/';
			axios.get(url)
				.then(response => {
					self.photoInfo = response.data.photoInfo;
					
				})
				.catch(error => {
					console.log(error)
				});
		},
		/*
		method
			ボタン押下時のイベントなどはmethod
			呼び出されるたびに毎回処理が走る
		*/
		methods: {
			// add methods
			deleteItem (item) {
				const index = this.photoInfo.indexOf(item.photo_id)
				confirm('削除しますか') && this.photoInfo.splice(index, 1)
				var url = '/api/photoInfo/'
				axios.delete(url + item.photo_id)
				.then(response => {
					alert("「" + item.photo_id + "」削除成功");
				})
				.catch(error => {
					console.log(error)
				});
			},

		/*
		this is the method to register photo infamation when the infomation was input..
		*/
			save () {
				this.photoInfo.push(this.editedItem)
				// add content in db
				var self = this
				var url = '/api/photoInfo/'
				axios.post(url, self.editedItem)
                .then(response => {
					// do not describe
					this.resetForm();
                })
                .catch(err => {
                    this.message = err
                });
				this.close()
			},
			close () {
				this.editedItem = Object.assign({}, this.editedItem)
			},
			/**
			 * resetForm フォームリセット
			 */
			resetForm () {
				this.editedItem = {};
			},
			/**
			 * downloadCSV CSVエクスポート
			 */
			downloadCSV () {
				var csv = '\ufeff' + '写真ID,撮影場所,都道府県,ISO,F値,シャッター時間,時間帯,三脚有無,備考\n'
				this.photoInfo.forEach(el => {
					var line = el['photo_id'] + ',' + el['shooting_location'] + ',' + el['prefecture'] +',' + el['iso'] +',' + el['f_value'] +',' + el['shutter_speed'] +',' + el['time_zone'] +',' + el['is_tripod'] +',' + el['other'] +'\n'
					csv += line
				})
				let blob = new Blob([csv], { type: 'text/csv' })
				let link = document.createElement('a')
				link.href = window.URL.createObjectURL(blob)
				link.download = 'Result.csv'
				link.click()
			}
		}
}
</script>