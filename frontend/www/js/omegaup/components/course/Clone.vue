<template>
  <div class="omegaup-course-clone panel">
    <div class="panel-body">
      <form class="form"
            v-on:submit.prevent="onSubmit">
        <div class="row">
          <div class="form-group col-md-6">
            <label>{{ T.wordsName }} <input class="form-control"
                   type="text"
                   v-model="name"></label>
          </div>
          <div class="form-group col-md-3">
            <label>{{ T.courseNewFormShortTitle_alias_ }} <span aria-hidden="true"
                  class="glyphicon glyphicon-info-sign"
                  data-placement="top"
                  data-toggle="tooltip"
                  v-bind:title="T.courseNewFormShortTitle_alias_Desc"></span> <input class=
                  "form-control"
                   type="text"
                   v-model="alias"></label>
          </div>
          <div class="form-group col-md-3">
            <label>{{ T.courseNewFormStartDate }} <span aria-hidden="true"
                  class="glyphicon glyphicon-info-sign"
                  data-placement="top"
                  data-toggle="tooltip"
                  v-bind:title="T.courseNewFormStartDateDesc"></span> <omegaup-datepicker v-model=
                  "startTime"></omegaup-datepicker></label>
          </div>
        </div>
        <div class="form-group pull-right">
          <button class="btn btn-primary"
               type="submit">{{ T.wordsCloneCourse }}</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import {T} from '../../omegaup.js';
import DatePicker from '../DatePicker.vue';

export default {
  props: {initialAlias: String, initialName: String},
  data: function() {
    return {
      T: T,
      alias: this.initialAlias,
      startTime: new Date(),
      name: this.initialName
    };
  },
  methods: {
    onSubmit: function() { this.$emit('clone', this);},
  },
  components: {
    'omegaup-datepicker': DatePicker,
  },
};
</script>

<style>
.omegaup-course-clone .form-group>label {
  width: 100%;
}
.omegaup-course-clone .faux-label {
  font-weight: bold;
}
</style>
