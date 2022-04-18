<!-- Fonts に追加 -->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">

<!-- Styles に追加 -->
<link href="{{ asset('css/user.css') }}" rel="stylesheet">

<body>
        <div id="app">
            <v-app>
                <header-component></header-component>
                <v-main>
                  <v-container fluid>
                    <router-view></router-view>
                  </v-container>
                </v-main>
                <v-footer app color="primary">
                </v-footer>
            </v-app>
        </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>