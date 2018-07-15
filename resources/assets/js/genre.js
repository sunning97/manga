var app = new Vue({
    el: '#app',
    data: {
        name:'',
        searchResult:[]
    },
    watch: {
        name: function () {
            this.getSearch()
        }
    },
    methods: {
        getSearch: function () {
            var app = this;
            if(app.name.length > 0) {
                axios.post('/admin/axios/search-genres', {
                    name: app.name
                }).then(rs => {
                    if(rs.data.length == 0){
                        app.searchResult = [];
                    } else {
                        app.searchResult = rs.data;
                    }
                }).catch(e => {
                });
            } else {
                app.searchResult = [];
            }
        },
        date_format: function(str){
            return date_format(str);
        },
        showDelete: function (event) {
            swal({
                title: "Bạn có chắc chắn Xóa?",
                text: "bạn sẽ không thể phục hồi lại thể loại này",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Xóa",
                closeOnConfirm: true
            }, function(){
                axios.delete($(event.path[0]).data('href')).then(rs => {
                    swal("Đã xóa!", rs.data +" dã được xóa bỏ", "success");
                    location.reload();
                }).catch(e =>{});
            });
        }
    }
});