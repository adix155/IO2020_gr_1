using System;
using System.Collections.Generic;
using System.Linq;
using System.Reflection.Metadata;
using System.Threading.Tasks;

namespace VoiceParametrizationApp.Models
{
    public class ParametersRepository : IParametersRepository
    {
        private List<Parameters> _paramsList;

        public ParametersRepository()
        {
            _paramsList = new List<Parameters>()
            {
                new Parameters() {Id = 1, User_id = 1, Patient_id = 1, CPP = 1.1, H1H2 = 2.2, HRF = 3.3, MDQ = 4.4, NAQ = 5.5, PS = 6.6, PSP = 7.7, QOQ = 8.8, RDS = 9.9},
                new Parameters() {Id = 2, User_id = 1, Patient_id = 2, CPP = 1.12, H1H2 = 2.22, HRF = 3.32, MDQ = 4.42, NAQ = 5.52, PS = 6.62, PSP = 7.72, QOQ = 8.82, RDS = 9.92},
                new Parameters() {Id = 3, User_id = 2, Patient_id = 3, CPP = 1.13, H1H2 = 2.23, HRF = 3.33, MDQ = 4.43, NAQ = 5.53, PS = 6.63, PSP = 7.73, QOQ = 8.83, RDS = 9.93}
            };
        }

        public Parameters Add(Parameters parameters)
        {
            parameters.Id = _paramsList.Max(p => p.Id) + 1;
            _paramsList.Add(parameters);
            return parameters;
        }

        public Parameters Delete(int id)
        {
            Parameters parameters = _paramsList.FirstOrDefault(p => p.Id == id);
            if (parameters != null)
            {
                _paramsList.Remove(parameters);
            }
            return parameters;
        }

        public IEnumerable<Parameters> GetAllParameters()
        {
            return _paramsList;
        }

        public Parameters GetParameters(int id)
        {
            return _paramsList.FirstOrDefault(p => p.Id == id);
        }

        public Parameters Update(Parameters paramsChanges)
        {
            Parameters parameters = _paramsList.FirstOrDefault(p => p.Id == paramsChanges.Id);
            if (parameters != null)
            {
                paramsChanges.CPP = paramsChanges.CPP;
                paramsChanges.H1H2 = paramsChanges.H1H2;
                paramsChanges.HRF = paramsChanges.HRF;
                paramsChanges.NAQ = paramsChanges.NAQ;
                paramsChanges.PSP = paramsChanges.PSP;
                paramsChanges.QOQ = paramsChanges.QOQ;
                paramsChanges.MDQ = paramsChanges.MDQ;
                paramsChanges.PS = paramsChanges.PS;
                paramsChanges.RDS = paramsChanges.RDS;
            }
            return parameters;
        }
    }
}
