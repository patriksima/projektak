import dateFormat from 'dateformat';

export default {
  methods: {
    /**
     * Method that parses given date.
     */
    parseDate(date, format) {
      return dateFormat(Date.parse(date), format);
    },

    /**
     * Time difrerence calculator.
     */
    getTimeDiff(datetime, now) {
      let diff = now - datetime;

      return `${Math.floor(diff/1000/3600)}:${dateFormat(new Date(diff), 'MM:ss')}`;
    }
  }
}
