<template>
    <tr>
        <td class="zui-sticky-col">{{ payroll.identity_card}} {{ payroll.city_identity_card }}</td>
        <td class="zui-sticky-col-1">{{ fullName(payroll) }}</td>
        <td>{{ payroll.account_number}}</td>
        <td>{{ payroll.birth_date}}</td>
        <td>{{ payroll.charge}}</td>
        <td>{{ payroll.position }}</td>
        <td><input type="number" v-model="days" :name="`contract-${payroll.contract_id}[]`" class="form-control" placeholder="dias trabajados" min="0" max="30"></td>
        <td>{{ baseWage | currency }}</td>
        <td>{{ quotable | currency }}</td>
        <td>{{ payroll.management_entity}}</td>
        <td>{{ calculateDiscount(procedure.discount_old) | currency }}</td>
        <td>{{ calculateDiscount(procedure.discount_common_risk) | currency }}</td>
        <td>{{ calculateDiscount(procedure.discount_commission) | currency }}</td>
        <td>{{ calculateDiscount(procedure.discount_solidary) | currency }}</td>
        <td>{{ calculateDiscount(procedure.discount_national) | currency }}</td>
        <td>{{ calculateTotalDiscountLaw() | currency }}</td>
        <td>{{ salary | currency}}</td>
        <td><input type="text" class="form-control" :name="`contract-${payroll.contract_id}[]`" v-model="rcIva"></td>
        <td><input type="text" class="form-control" :name="`contract-${payroll.contract_id}[]`" v-model="delay"></td>
        <td> {{ totalDiscounts | currency }} </td>
        <td> {{ total | currency}} </td>
    </tr>
</template>

<script>
export default {
  props:['payroll', 'procedure'],
  data(){
    return{
        days: this.payroll.worked_days,
        di: null,
        baseWage: this.payroll.base_wage,
        delay: this.payroll.discount_faults,
        rcIva: this.payroll.discount_rc_iva,
    }
  },
  created(){
    //   console.log(this.payroll);
  },
  methods:{
      fullName(payroll){
          let name = `${payroll.last_name || ''} ${payroll.mothers_last_name || ''} ${payroll.surname_husband || ''} ${payroll.first_name || ''} ${payroll.second_name || ''} `
          name = name.replace(/\s+/gi, ' ').trim().toUpperCase();
          return name;
      },
      calculateDiscount(discount){
          return (this.quotable * discount)/100;
      },
      calculateTotalDiscountLaw(){
        return this.calculateDiscount(this.procedure.discount_old)+this.calculateDiscount(this.procedure.discount_common_risk)+this.calculateDiscount(this.procedure.discount_commission)+this.calculateDiscount(this.procedure.discount_solidary)+this.calculateDiscount(this.procedure.discount_national);
      },

  },
  computed:{
      total(){
          return this.quotable - this.totalDiscounts;
      },
      totalDiscounts(){
          return this.calculateTotalDiscountLaw() + parseFloat(this.delay || 0 ) + parseFloat(this.rcIva || 0);
      },
      quotable()  {
          return (this.baseWage/30)*this.days;
      },
      salary(){
          return this.quotable - this.calculateTotalDiscountLaw();
      }
  },
}
</script>