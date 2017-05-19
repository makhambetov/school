<div class="col-md-8 col-sm-12 jumbotron content-item">
    <h1>My School</h1>
    <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>-->
</div>


<div class="col-md-8 col-sm-12 classes content-item" hidden>
    <div class="panel panel-success">
        <div class="panel-heading"><b>Список классов: </b></div>
        <div class="panel-body">
            <ol class="list-group">
                 <li class="list-group-item" v-for="item in classes" @click="showClass(item)"><span><b>{{item.name}}</b> &nbsp;&nbsp;| &nbsp;&nbsp; Класс.рук: {{item.teacher_name}}</span></li>
            </ol>
            <div class="btn-group pull-right">
                <div class="btn btn-primary" @click="add" data-toggle="modal" data-target="#modal_class">Добавить</div>
                <div class="btn btn-success" @click="edit" data-toggle="modal" data-target="#modal_class">Изменить</div>
                <div class="btn btn-danger"  @click="remove(classes)">Удалить</div>
            </div>
        </div>
    </div>
</div>


<div  class="col-md-8 col-sm-12 students content-item" hidden>
    <div class="panel panel-info">
        <div class="panel-heading"><b>Список учеников: </b></div>
        <div class="panel-body">
            <ol class="list-group">
                <li class="list-group-item" v-for="item in students" @click="showStudent(item)"><span>{{item.student_name}}</span></li>
            </ol>
            <div class="btn-group pull-right">
                <div class="btn btn-primary" @click="add" data-toggle="modal" data-target="#edit">Добавить</div>
                <div class="btn btn-success" @click="edit" data-toggle="modal" data-target="#edit">Изменить</div>
                <div class="btn btn-danger"  @click="remove(students)">Удалить</div>
            </div>
        </div>
    </div>
</div>


<!--Модальное окно-->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Редактировать данные ученика</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Имя</div>
                            <input type="text" class="form-control" v-model="editing.student_name">
                        </div>
                    </div>
                </form>
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Класс</div>
                            <select class="form-control" v-model="editing.class_id">
                                <option v-for="item in classes" :value="item.name">{{item.name}}</option>
                            </select>
                        </div>
                    </div>
                </form>
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Балл</div>
                            <select class="form-control" v-model="editing.mark">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </form>
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Начало учебы</div>
                            <input size="20" type="date" class="form-control" v-model="editing.start_date">
                        </div>
                    </div>
                </form>
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Конец учебы</div>
                            <input type="date" class="form-control" v-model="editing.end_date">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" @click="save(students)">Сохранить</button>
            </div>
        </div>
    </div>
</div>


<!--Модальное окно-->
<div class="modal fade" id="modal_class" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Редактировать данные класса</h4>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Класс</div>
                            <input type="text" class="form-control" v-model="editing.name">
                        </div>
                    </div>
                </form>
                <form class="form-inline">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">Клас. рук.</div>
                            <input type="text" class="form-control" v-model="editing.teacher_name">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary" @click="save(classes)">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<div id="res"></div>
