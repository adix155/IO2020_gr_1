using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace VoiceParametrizationApp.Models
{
    public class Patient
    {
        public int ID { get; set; }
        public int Parameters_id { get; set; }
        public string Name { get; set; }
        public string Surname { get; set; }
        public string Gender { get; set; }
        public int Age { get; set; }
    }
}
