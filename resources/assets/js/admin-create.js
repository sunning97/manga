var app = new Vue({
    el:'#app',
    data:{
        provinces:[],
        districts:[],
        wards:[],
        isAddress:false,
        isProvince:false,
        isDistrict:false,
        isPassword:false
    },
    mounted(){
        this.getProvinces();
    },
    methods:{
        getProvinces:function () {
            axios.get('/admin/axios/provinces').then(response=>{
                this.provinces = response.data;
            })
        },
        getDistricts:function (e) {
            this.isProvince = true;
            axios.get(`/admin/axios/districts/${$(e.path[0]).val()}`).then(response=>{
                this.districts = response.data;
            })
        },
        getWards:function (e) {
            this.isDistrict = true;
            axios.get(`/admin/axios/wards/${$(e.path[0]).val()}`).then(response=>{
                this.wards = response.data;
            });
        }
    }
});

$("#signupForm").validate({
    rules: {
        f_name: "required",
        l_name: "required",
        password: {
            required: true,
            minlength: 6
        },
        confirm_password: {
            required: true,
            minlength: 6,
            equalTo: "#password"
        },
        province: "required",
        district: "required",
        ward: "required",
        street: "required",
        email: {
            required: true,
            email: true
        },
    },
    messages: {
        f_name: "Họ không được để trống!",
        l_name: "Tên không được để trống",
        password: {
            required: "Nhập mật khẩu",
            minlength: "Mật khẩu phải nhiều hơn 5 kí tự"
        },
        confirm_password: {
            required: "Nhập mật khẩu",
            minlength: "Mật khẩu phải nhiều hơn 5 kí tự",
            equalTo: "Mật khẩu không khớp!"
        },
        province: "Vui lòng chọn Tỉnh/Thành phố",
        district: "Vui lòng chọn Quận/Huyện",
        ward: "Vui lòng chọn Phường/Xã",
        street: "Vui lòng nhập tên đường, số nhà",
        email: "Vui lòng nhập email!",
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