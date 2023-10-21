<template>
  <footer class="footer">Copyright <strong>UnionData - UDash</strong> &#0169; 2021 - 2021</footer>
</template>

<script>
export default {
  name: 'Footer'
}
</script>

<style>
  .footer{
      grid-area: footer;
      background-color: #DDD;
      color: #333;

      display: flex;
      align-items: center;
      justify-content: flex-end;
      padding-right: 10px;
  }
</style>
