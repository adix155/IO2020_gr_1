using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace VoiceParametrizationApp.Models
{
    public interface IParametersRepository
    {
        Parameters GetParameters(int id);
        IEnumerable<Parameters> GetAllParameters();
        Parameters Add(Parameters parameters);
        Parameters Update(Parameters paramsChanges);
        Parameters Delete (int id);
    }
}
