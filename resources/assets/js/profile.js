var app = new Vue({
    el: '#app',
    data: {
        name:name,
        isChangeInfo:false,
        isChangeAvatar: false,
        isChangeAddress:false,
        isChangePassword:false,
        isProvinceSelected: false,
        isDistrictSelected: false,
        provinceId:'',
        districtId:'',
        provinces: [],
        districts:[],
        wards:[]
    },
    watch: {
        name: function (str) {
            this.getSlug(str)
        }
    },
    methods: {
        getSlug: function(str) {
            return str_slug(str);
        },
        getProvinces: function(){
            axios.get('/manga/axios/provinces').then(rs => {
                this.provinces = rs.data;
            }).catch(e =>{});
        },
        getDistricts: function(id){
            axios.get('/manga/axios/districts/'+id).then(rs => {
                this.districts = rs.data;
                this.wards = [];
                this.isProvinceSelected = true;
            }).catch(e =>{});
        },
        getWards: function(id){
            axios.get('/manga/axios/wards/'+id).then(rs => {
                this.wards = rs.data;
                this.isDistrictSelected = true;
            }).catch(e =>{});
        }
    },mounted: function () {
        this.getProvinces();
    }
});

$('#passForm').validate({
    rules: {
        curr_password:{
            required: true
        },
        password: {
            required: true,
            minlength: 5
        },
        confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#pass"
        },
    },
    messages: {
        curr_password:{
            required: "Vui lòng nhập mật khẩu hiện tại"
        },
        password: {
            required: "Vui lòng nhập mật khẩu mới",
            minlength: "Mật khẩu phải dài ít nhất 5 kí tự"
        },
        confirm_password: {
            required: "Vui lòng nhập mật khẩu mới",
            minlength: "Mật khẩu phải dài ít nhất 5 kí tự",
            equalTo: "Mật khẩu đã nhập không khớp!"
        }
    },
    errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
    },
    highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger');
        $(element).addClass('form-control-danger');
    }
});

jQuery('.mydatepicker').datepicker();
$('#input-file-now').dropify();