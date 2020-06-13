<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
<div id="logs">
    <div>@{{ error }}</div>
    <div>
        <button @click.prevent="updateData" type="button">Update Data</button>
    </div>
    <div style="word-break: break-word;" v-html="log"></div>
</div>
<script>
    let data = {
        url: '{{URL::to('/read-log')}}',
        log: '',
        error: '',
    };

    let logs = new Vue({
        data: data,
        el: '#logs',
        mounted: function () {
            this.getData();
        },
        methods: {
            getData: function () {
                let $this = this;

                axios.get("{{URL::to('/read-log')}}").then(response => {
                    $this.log = response.data.log;
                    window.scrollTo(0, document.body.scrollHeight);
                }).catch(error => {
                    $this.error = error;
                });
            },
            updateData: function () {
                this.getData();
            }
        }
    });
</script>
</body>
</html>