<template>
  <input v-model="this.input" @input="this.setupPhoneFormatting" type="tel" />
</template>
<script>
export default {
  data() {
    return {
      input: this.modelValue,
    };
  },
  props: {
    modelValue: {
      type: String,
      default: "",
    },
  },
  methods: {
    setupPhoneFormatting(event) {
      const prefixNumber = (str) => {
        
        if (str === "7") {
          return "7 (";
        }
        
        if (str === "8") {
          return "+7 (";
        }
        
        if (str === "9") {
          return "7 (9";
        }
        
        return "7 (";
      };

      const inputElement = event.target;
      const value = inputElement.value.replace(/\D+/g, "");
      const numberLength = 11;

      
      let result;
      
      if (inputElement.value.includes("+8") || inputElement.value[0] === "8") {
        
        result = "";
      } else {
        
        result = "+";
      }

      
      for (let i = 0; i < value.length && i < numberLength; i++) {
        switch (i) {
          case 0:
            
            result += prefixNumber(value[i]);
            continue;
          case 4:
            
            result += ") ";
            break;
          case 7:
            
            result += "-";
            break;
          case 9:
            
            result += "-";
            break;
          default:
            break;
        }
        
        result += value[i];
      }
      
      inputElement.value = result;

      this.input = result.trim();
      this.$emit("update:modelValue", result.trim());
    },
  },
};
</script>
<style lang=""></style>
