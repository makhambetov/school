<!--<h3 id="lable"><div class="label label-success">Меню</div></h3>-->
<div class="list-group">
        <a href="" class="list-group-item menu-item" id="lable">Меню</a>
        <a href="" class="list-group-item menu-item" id="m_classes" @click="selectClasses">Классы<span class="badge">{{this.classes.length}}</span></a>
        <a href="" class="list-group-item menu-item" id="m_students" @click="selectStudents">Ученики<span class="badge">{{this.students.length}}</span></a>
    </div>


    <div  class="class-profile content-item" hidden>

        <div class="panel panel-info">
            <div class="panel-heading"><b>{{selected.id}}</b></div>
            <table class="table table-bordered">
                <tr><td>Классный руководитель</td><td>{{selected.teacher_name}}</td></tr>
                <tr><td>Средний балл</td><td>{{selected.av_mark}}</td></tr>
                <tr><td>Количество учеников</td><td>{{selected.stud_count}}</td></tr>
            </table>
        </div>

        <div class="panel panel-warning">
            <div class="panel-heading"><b>Список учеников класса:</b></div>
            <div class="panel-body">
                <ol class="list-group" >
                    <li class="list-group-item" v-for="item in students" v-if="item.class_id==selected.id" @click="showClassesStudent(item)">{{item.student_name}}</li>
                </ol>
            </div>
        </div>

    </div>



    <div  class="student-profile content-item" hidden>
        <div class="panel panel-info">
            <div class="panel-heading"><b>{{selected.student_name}}</b></div>
            <!--       <div class="content-item photo" hidden>
                            <img src="img/user.png" alt="...">
                        </div>-->
            <table class="table table-bordered">
                <tr><td>Класс</td><td class="list-group-item" @click="showStudentsClass"><u>{{selected.class_id}}</u></td></tr>
                <tr><td>Балл</td><td>{{selected.mark}}</td></tr>
                <tr><td>Начало учебы</td><td>{{selected.start_date}}</td></tr>
                <tr><td>Конец учебы</td><td>{{selected.end_date}}</td></tr>
            </table>
        </div>
    </div>



</div>