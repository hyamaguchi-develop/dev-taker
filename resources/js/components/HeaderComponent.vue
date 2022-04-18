<template>
    <div>
        <v-app-bar color="grey darken-4" dark app clipped-left>
            <v-app-bar-nav-icon @click="drawer=!drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>一覧ページ</v-toolbar-title>
        </v-app-bar>
        <!-- class:背景色 -->
        <v-navigation-drawer
            app
            v-model="drawer"
            clipped
            class="grey darken-4"
            dark>
            <!-- サイドバーに表示させるlistを作成する -->
            <v-list>
                <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    :href="item.to"
                    link
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>
    </div>
</template>

<script>
export default {
	data(){
		return {
            drawer : null,
            // json形式でサイドバーのリスト項目設定
            /**
             * ToDo:
             * icon設定 https://dev.materialdesignicons.com/icons
             * mdi-を付けて指定
             * 20210531- vuetify公式リファレンス参照
             */
            items: [
                {title: '管理者', icon: 'mdi-home', to: "/admin"},
                {title: '撮影場所一覧', icon: 'mdi-view-dashboard', to: "/place"},
                {title: '写真登録', icon: 'mdi-image', to: "/photo-display"}
            ]
        }
    }
}
</script>