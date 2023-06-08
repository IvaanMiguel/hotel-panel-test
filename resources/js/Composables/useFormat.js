export default function useFormat(){
    const numberFormat = (amount, decimal_quantity, format) => {
        const nAmount = amount ? Number(amount) : 0
        return nAmount.toLocaleString(format, {minimumFractionDigits:decimal_quantity , maximumFractionDigits: decimal_quantity})
    }

    const currencyFormat = (amount, currency) => {
        const nAmount = amount ? Number(amount) : 0
        
        return (
            currency.symbol + 
            nAmount.toLocaleString(currency.format, {minimumFractionDigits:currency.decimals_quantity , maximumFractionDigits: currency.decimals_quantity}) 
            + " " + currency.code
        )
    }

    const dateFormat = date => {
        return date ? date.split('-').reverse().join('/') : ''
    }

    const formatDateText = (date) => {
        var monthNames = [
          "Ene",
          "Feb",
          "Mar",
          "Abr",
          "May",
          "Jun",
          "Jul",
          "Ago",
          "Sep",
          "Oct",
          "Nov",
          "Dic",
        ];
        var d = new Date(date),
          month = "" + monthNames[d.getMonth()],
          day = "" + d.getDate(),
          year = d.getFullYear();

        if (month.length < 2) month = "0" + month;
        if (day.length < 2) day = "0" + day;
        
        return (day + " " + month + ' ' + year);
    }

    const formatDateHour = (dateHour) => {
        if(dateHour!= null){

            const date = dateHour.split(/[T\s]/);
            const dateFormat = `${date[0].split(["-"]).reverse().join("/")} ${
                date[1].substr(0,5)
            }`;
            return dateFormat;
        }
        return '0/00/0000 00:00'
    };

    const formatDateHourTextFull = (date) => {
        var monthNames = [
          "Enero",
          "Febrero",
          "Marzo",
          "Abril",
          "Mayo",
          "Junio",
          "Julio",
          "Agosto",
          "Septiembre",
          "Octubre",
          "Noviembre",
          "Diciembre",
        ];
        var d = new Date(date),
          month = "" + monthNames[d.getMonth()],
          day = "" + d.getDate(),
          year = d.getFullYear(),
          hours = d.getHours(),
          mins = d.getMinutes(),
          time = 'AM';

        if (month.length < 2) month = "0" + month;
        if (day.length < 2) day = "0" + day;
        
        if(hours == 24) {
            hours = 0
        }
        if(hours >= 12) {
            time = 'PM'
            hours -= 12
        }

        if (hours < 10) hours = "0" + hours;
        if (mins < 10) mins = "0" + mins;
        
        return (day + " de " + month + ', ' + year + ' ' + hours + ':' + mins + time);
    }

    const formatDateHourTextShort = (date) => {
        var monthNames = [
          "Ene",
          "Feb",
          "Mar",
          "Abr",
          "May",
          "Jun",
          "Jul",
          "Ago",
          "Sep",
          "Oct",
          "Nov",
          "Dic",
        ];
        var d = new Date(date),
          month = "" + monthNames[d.getMonth()],
          day = "" + d.getDate(),
          year = d.getFullYear(),
          hours = d.getHours(),
          mins = d.getMinutes(),
          time = 'AM';

        if (month.length < 2) month = "0" + month;
        if (day.length < 2) day = "0" + day;
        
        if(hours == 24) {
            hours = 0
        }
        if(hours >= 12) {
            time = 'PM'
            hours -= 12
        }

        if (hours < 10) hours = "0" + hours;
        if (mins < 10) mins = "0" + mins;
        
        return (day + " " + month + ' ' + year + ', ' + hours + ':' + mins + time);
    }

    const dateFormatHtml = (date) => {
        if(!date) return;
        const fullDate = date.split(' ')
        return `
            <span>${fullDate[0].split('-').reverse().join('/')}</span><br>
            <span class="mt-2">${fullDate[1]}</span>
        `
    }

    return {
        numberFormat,
        dateFormat,
        dateFormatHtml,
        formatDateHour,
        formatDateText,
        formatDateHourTextFull,
        formatDateHourTextShort,
        currencyFormat,
    }
}
