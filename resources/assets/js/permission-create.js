var app = new Vue({
    el: '#app',
    data: {
        name:'',
        type:'basic',
        checkedType: ['create','update','read','delete'],
        namePut:[],
        slugPut:[],
        desPut:[]
    },
    watch: {
        name: function (str) {
            this.getSlug(str);
            this.getNamePut();
            this.getSlugPut();
            this.getDesPut();
        },
        checkedType: function () {
            this.getNamePut();
            this.getSlugPut();
            this.getDesPut();
        }
    },
    methods: {
        getSlug: function(str) {
            return str_slug(str);
        },
        getUcFirst: function(str){
            var arr = str.split(' ');
            var result = '';
            for (let i = 0;i< arr.length;i++){
                result += arr[i].charAt(0).toUpperCase() + arr[i].slice(1)+' ';
            }
            return result.trim(' ');
        },
        getNamePut: function () {
            this.namePut = [];
            if(this.name.length > 0) {
                for (let i = 0; i < this.checkedType.length; i++) {
                    if (this.checkedType[i] == 'create') {
                        this.namePut[i] = 'Thêm ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'update') {
                        this.namePut[i] = 'Cập Nhật ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'read') {
                        this.namePut[i] = 'Xem ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'delete') {
                        this.namePut[i] = 'Xóa ' + this.getUcFirst(this.name);
                    }
                }
            }
        },
        getSlugPut: function () {
            this.slugPut = [];
            if(this.name.length > 0) {
                for (let i = 0; i < this.checkedType.length; i++) {
                    if (this.checkedType[i] == 'create') {
                        this.slugPut[i] = this.getSlug(this.checkedType[i] + ' ' + this.name);
                    } else if (this.checkedType[i] == 'update') {
                        this.slugPut[i] = this.getSlug(this.checkedType[i] + ' ' + this.name);
                    } else if (this.checkedType[i] == 'read') {
                        this.slugPut[i] = this.getSlug(this.checkedType[i] + ' ' + this.name);
                    } else if (this.checkedType[i] == 'delete') {
                        this.slugPut[i] = this.getSlug(this.checkedType[i] + ' ' + this.name);
                    }
                }
            }
        },
        getDesPut: function () {
            this.desPut = [];
            if(this.name.length > 0) {
                for (let i = 0; i < this.checkedType.length; i++) {
                    if (this.checkedType[i] == 'create') {
                        this.desPut[i] = 'Cho phép người dùng thêm mới ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'update') {
                        this.desPut[i] = 'Cho phép người dùng cập nhật ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'read') {
                        this.desPut[i] = 'Cho phép người dùng xem ' + this.getUcFirst(this.name);
                    } else if (this.checkedType[i] == 'delete') {
                        this.desPut[i] = 'Cho phép người dùng xóa ' + this.getUcFirst(this.name);
                    }
                }
            }
        },
        resetName: function(){
            this.name = ''
        }
    }
});