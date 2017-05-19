/*var profileModel =
    {
        name:'',
        class:0,
        mark:0,
        start:'',
        end:''
    };*///var editing = {};
//инициализация объекта Vue
var vm = new Vue({
    el: '#app',             //HTML элемент присваивания Vue
    //переменные объекта Vue
    data: {
        classes: [],        //массив со списком учеников
        students:[],        //массив со списком классов
        indexOfSelected:0,  //индекс выделенного элемента(ученик или класс)
        selected: {},       //выбранный элемент(ученик или класс)
        editing:{},         //изменяемый элемент(ученик или класс)
        option:''           //модификатор для функции сохранения (новый элемент или редактируемый)
    },
    //методы объекта Vue
    methods: {
        selectClasses:function (e) {    //функция-обработчик отображает список классов
            e.preventDefault();
           $('.list-group-item').removeClass('active')
           $('#m_classes').addClass('active')
           $('.content-item').attr('hidden', '');
           $('.classes').removeAttr('hidden');
        },
        selectStudents:function(e){     //функция-обработчик отображает список учеников
            e.preventDefault();
            $('.menu-item').removeClass('active')
            $('#m_students').addClass('active')
            $('.content-item').attr('hidden', '');
            $('.students').removeAttr('hidden');
        },
        showClass:function (item) {     //функция-обработчик отображает профиль класса
            $('.content-item').attr('hidden', '');
            $('.class-profile, .classes').removeAttr('hidden');
            this.indexOfSelected = this.classes.indexOf(item);
            this.selected =  item;
            this.setClass('classes');
        },
        showStudent:function (item) {   //функция-обработчик отображает профиль ученика
            $('.content-item').attr('hidden', '');
            $('.student-profile, .students').removeAttr('hidden');
            this.indexOfSelected = this.students.indexOf(item);
            this.selected = item;
            this.setClass('students');
        },
        showStudentsClass:function () { //функция-обработчик отображает профиль класса выбранного ученика
            $('.content-item').attr('hidden', '');
            $('.class-profile, .classes').removeAttr('hidden');
            this.classes.forEach(function (p1) {
                if (p1.name == this.selected.class_id)
                    this.selected = p1;
            }.bind(this));
            this.indexOfSelected = this.classes.indexOf(this.selected);
            this.setClass('classes');
            $('#m_students').removeClass('active');
            $('#m_classes').addClass('active')
        },
        showClassesStudent:function (item) {//функция-обработчик отображает профиль ученика выбранного класса
            $('.content-item').attr('hidden', '');
            $('.student-profile, .students').removeAttr('hidden');
            this.selected = item;
            this.indexOfSelected = this.students.indexOf(item)
            this.setClass('students');
            $('#m_classes').removeClass('active');
            $('#m_students').addClass('active')
        },
        add:function () {   //функция-обработчик на кнопку ДОБАВИТЬ
            this.editing = {};//Object.assign({}, profileModel);
            this.option = 'new';
        },
        edit:function () {  //функция-обработчик на кнопку ИЗМЕНИТЬ
            this.editing = this.selected;//Object.assign({}, this.selected);
            this.option = 'edit';
        },

        //функция-обработчик на кнопку СОХРАНИТЬ. Принимает массив элементов в качестве аргумента
        save:function (list) {

            //Запрос на добавление нового элемента
            if(this.option === 'new'){
                if(list === this.students) var req = "q=new_s";
                if(list === this.classes)  var req = "q=new_c";
                if(!$.isEmptyObject(this.editing)) {
                    $.ajax({
                        url: 'updateDB.php',
                        method: 'POST',
                        data: req + '&data=' + JSON.stringify(this.editing),
                        success: function () {
                            list.push(vm._data.editing);
                            vm._data.editing = {}
                        }
                    });
                }
            }

            //Запрос на изменение выбранного элемента
            if(this.option === 'edit'){
                if(list === this.students) var req = "q=edit_s";
                if(list === this.classes)  var req = "q=edit_c";
                $.ajax({
                    url:'updateDB.php',
                    method:'POST',
                    data: req + '&data=' + JSON.stringify(this.editing),
                    success: function (d) {
                        vm._data.selected = vm._data.editing;
                        var index;
                        if(list == vm._data.students){
                            vm._data.classes.forEach(function (obj) {
                                if (obj.name == vm._data.selected.class_id)
                                    index = vm._data.classes.indexOf(obj);
                            });
                            vm._data.classes[index].av_mark = d;
                            }
                        //$('#res').html(d)
                        }
                });
            }
        },

        //функция-обработчик на кнопку УДАЛИТЬ. Принимает массив элементов в качестве аргумента
        remove:function (list) {
            if(this.selected.stud_count > 0){
                alert("Не пустой класс не может быть удален");
                return;
            }
            if(list.length)
                var confirmed = confirm('Действительно удалить?');
            if(confirmed){
                list.splice(this.indexOfSelected, 1);
                if(list === this.students) var req = "q=remove_s";
                if(list === this.classes)  var req = "q=remove_c";
                $.ajax({
                    url:"updateDB.php",
                    method:"POST",
                    data: req + "&id=" + this.selected.id + "&class_id=" + this.selected.class_id,
                    success:function (d) { /*$('#res').html(d)*/ }
                });
                if(this.indexOfSelected != 0)
                    this.indexOfSelected--;
                if(list.length)
                    this.selected = list[this.indexOfSelected];
                else
                    this.selected = {}
            }
        },

        //функция присваивает CSS класс выбранному элементу
        //принимает арумент - группу элементов
        setClass:function (group) {
            $("."+ group + " .list-group-item").removeClass("selected");
            $("."+ group + " .list-group-item").eq(this.indexOfSelected).addClass("selected");
        },
    },
    mounted:function(){
        //загрузка данных с БД
        $.ajax({
            url:'loadDB.php?loadDB=classes',
            method:"GET",
            success:function (data) {
                this.classes = JSON.parse(data)
            }.bind(this)
        });

        $.ajax({
            url:'loadDB.php?loadDB=students',
            method:"GET",
            success:function (data) {
                this.students = JSON.parse(data);
                this.students.forEach(function(obj){
                    if (obj.start_date == '0000-00-00') obj.start_date = '-'
                    if (obj.end_date == '0000-00-00') obj.end_date = '-'
                });
            }.bind(this)
        });
    }

})
