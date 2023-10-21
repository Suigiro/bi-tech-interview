<template>
    <div class="numeros">
        <div class="numeros-icon">
            <i :class="icon" :style="style"></i>
        </div>
        <div class="numeros-info">
            <span class="numeros-title">{{ title }}</span>
            <span class="numeros-value">{{ value }}</span>
        </div>
    </div>
</template>

<script>
export default {
  name: 'Numeros',
  props: ['title', 'value', 'icon', 'color'],
  computed: {
    style () {
      return 'color: ' + (this.color || '#000')
    }
  }
}
</script>

<style>
    .numeros {
        flex: 1;
        display: flex;
        border-radius: 8px;
        margin-right: 20px;
        margin-bottom: 20px;
        background-color: #FFF;
        padding: 20px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);
    }

    .numeros-icon {
        display: flex;
        align-items: center;
    }

    .numeros-icon i {
        font-size: 5rem;
    }

    .numeros-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .numeros-title {
        font-size: 1.15rem;
        font-weight: bolder;
    }

    .numeros-value {
        font-size: 3rem;
    }
</style>
