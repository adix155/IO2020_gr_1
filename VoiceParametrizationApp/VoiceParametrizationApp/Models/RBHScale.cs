using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace VoiceParametrizationApp.Models
{
    public class RBHScale
    {
        public int Id { get; set; }
        public int User_id { get; set; }
        public int Parameters_id { get; set; }
        public int R { get; set; }
        public int B { get; set; }
        public int H { get; set; }
    }
}
