<template>
  <footer class="footer">Copyright &nbsp;<strong>Saude Paciente</strong> &#0169; 2023 - 2023</footer>
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
