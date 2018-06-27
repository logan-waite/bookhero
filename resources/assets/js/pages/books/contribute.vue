<template>
  <div id='contribute'>
    <form>
      <div class="form-row">
        <div class="form-group col">
          <input class="form-control" type="text" placeholder="Title">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col">
          <input class="form-control" type="text" placeholder="Author">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col">
          <input class="form-control" type="text" placeholder="Summary">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-8">
          <select class="form-control">
            <option>Attribute 1</option>
          </select>
        </div>
        <div class="form-group col-4">
          <input class="form-control" type="number" value="3">
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      title: '',
      author: '',
      summary: '',
      attributes: [],
    }
  }
}
</script>