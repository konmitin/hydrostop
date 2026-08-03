<template>
  <div>
    <div class="text-xs text-gray-600 uppercase mb-1 font-medium">{{ this.title }}</div>

    <div class="font-medium text-gray-900">
      <slot></slot>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      default: "",
    },
  },
};
</script>
<style scoped>
.form-input {
  color: var(--color-gray-800);
  width: 100%;
  padding: 0.625rem 1rem;
  border: 1px solid #e0e0e0;
  border-radius: 0.5rem;
  font-size: 0.875rem;
  transition: all 0.2s ease;
  background-color: white;
}

.form-input:focus {
  outline: none;
  border-color: var(--color-gray-800);
  box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.05);
}

.form-label {
  font-size: 0.75rem;
  font-weight: 600;
  color: #5a5a5a;
  margin-bottom: 0.375rem;
  display: block;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

/* Блок информации */
.info-section {
  max-width: 24rem;
  margin-bottom: 1.5rem;
  /* padding-bottom: 1rem; */
  /* border-bottom: 1px solid var(--color-gray-300); */
}

.info-section__title,
.info-section__subtitle {
  color: var(--color-gray-500);
}

.info-section__title {
  text-transform: uppercase;
  font-size: 1rem;
  font-weight: 500;
  letter-spacing: 0.03em;
  margin-bottom: 0.5rem;
  display: block;
}

.info-section__subtitle {
  font-size: 0.9rem;
  font-weight: 400;
  color: var(--color-gray-400);
}

.info-value {
  display: inline-block;
  overflow: hidden;
  max-width: 24rem;
  text-wrap: wrap;
  height: 100%;
  font-size: 0.95rem;
  font-weight: 500;
  color: var(--color-gray-900);
  line-height: 1.4;
}

.info-sub {
  font-size: 0.8rem;
  color: #9a9a9a;
  margin-top: 0.25rem;
}

/* Разделитель */
.divider {
  height: 1px;
  background: #f0f0f0;
  margin: 1rem 0;
}

/* Статус-бейдж */
.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.375rem;
  padding: 0.25rem 0.75rem;
  border-radius: 9999px;
  font-size: 0.75rem;
  font-weight: 500;
}

.status-active {
  background-color: #e6f7e6;
  color: #2e7d32;
}

.status-inactive {
  background-color: #ffebee;
  color: #c62828;
}

.tab-button {
  padding: 0.875rem 1.5rem;
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--color-gray-400);
  transition: all 0.2s ease;
  border-bottom: 2px solid transparent;
  cursor: pointer;
  gap: 0.5rem;
}

.tab-button:hover {
  color: var(--color-gray-800);
}

.tab-button.active {
  color: var(--color-gray-800);
  border-bottom-color: var(--color-gray-800);
}

/* service */
.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 0.75rem;
}

.service-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.875rem 1.2rem;
  background: var(--color-gray-800);
  border-radius: 0.75rem;
  border: 1px solid #f0f0f0;
  transition: all 0.2s ease;
}

.service-item:hover {
  background: var(--color-gray-600);
  border-color: #e0e0e0;
}

.service-name {
  font-size: 0.875rem;
  font-weight: 500;
  color: var(--color-white);
}

.service-price {
  font-size: 0.875rem;
  font-weight: 600;
  color: var(--color-white);
}

.service-price-old {
  font-weight: 400;
  color: #c0c0c0;
  text-decoration: line-through;
}

.service-status-badge {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 0.5rem;
}

.service-status-active {
  background-color: #2e7d32;
}

.service-status-inactive {
  background-color: #c62828;
}</style>
