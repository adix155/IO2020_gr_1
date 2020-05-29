using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace VoiceParametrizationApp.Models
{
    public class Parameters
    {
        public int Id { get; set; }
        public int User_id { get; set; }
        public int Patient_id { get; set; }
        public double CPP { get; set; }
        public double H1H2 { get; set; }
        public double HRF { get; set; }
        public double NAQ { get; set; }
        public double PSP { get; set; }
        public double QOQ { get; set; }
        public double MDQ { get; set; }
        public double PS { get; set; }
        public double RDS { get; set; }
    }
}
