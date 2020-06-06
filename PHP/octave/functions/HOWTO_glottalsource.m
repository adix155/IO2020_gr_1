% Short test script for running algorithms related to the glottal source
%
% Please find the path management in the startup.m script in the root directory
% of this repository. Note that by starting matlab in the root directory, this
% script should automatically run. If it is not the case, you can also move to the
% root directory and run this script manually. 
%
% License
%  This file is under the LGPL license,  you can
%  redistribute it and/or modify it under the terms of the GNU Lesser General 
%  Public License as published by the Free Software Foundation, either version 3 
%  of the License, or (at your option) any later version. This file is
%  distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
%  without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
%  PARTICULAR PURPOSE. See the GNU Lesser General Public License for more
%  details.
%
% This function is part of the Covarep project: http://covarep.github.io/covarep
%

clear all;

% Settings
F0min = 80; % Minimum F0 set to 80 Hz
F0max = 500; % Maximum F0 set to 80 Hz
frame_shift = 10; % Frame shift in ms

% Load soundfile
[x,fs] = audioread('C:\Users\Kolonoskopia\Desktop\git\vpadb_file_no_1.wav');

% Check the speech signal polarity


% Extract the pitch and voicing information
[srh_f0,srh_vuv,srh_vuvc,srh_time] = pitch_srh(x,fs,F0min,F0max,frame_shift);

% Extract the maximum voiced frequency
%[max_voiced_freq] = maximum_voiced_frequency(x,fs,srh_f0.*srh_vuv,srh_time);

% Creaky probability estimation
warning off
try
    [creak_pp,creak_bin] = detect_creaky_voice(x,fs); % Detect creaky voice
    creak=interp1(creak_bin(:,2),creak_bin(:,1),1:length(x));
    creak(creak<0.5)=0; creak(creak>=0.5)=1;
    do_creak=1;
catch
    disp('Version or toolboxes do not support neural network object used in creaky voice detection. Creaky detection skipped.')
    creak=zeros(length(x),1);
    creak_pp=zeros(length(x),2);
    creak_pp(:,2)=1:length(x);
    do_creak=0;
end
warning on

% GCI estimation
sd_gci = gci_sedreams(x,fs,median(srh_f0),1);        % SEDREAMS
se_gci = se_vq(x,fs,median(srh_f0),creak);           % SE-VQ///////////////////////////////////////////////////////////////////////

%res = lpcresidual(x,25/1000*fs,5/1000*fs,fs/1000+2); % LP residual
res = maxlpresidual(x,fs,round(fs/1000)+2);

mDQ = mdq(res,fs,se_gci); % Maxima dispersion quotient measurement///////////////////////////////////////////////////////////////////////

ps = peakslope(x,fs);   % peakSlope extraction///////////////////////////////////////////////////////////////////////

[gf_iaif,gfd_iaif] = iaif_ola(x,fs);    % Glottal flow (and derivative) by the IAIF method///////////////////////////////////////////////////////////////////////

dgf_cc = complex_cepstrum(x,fs,sd_gci,srh_f0,srh_vuv);

[NAQ,QOQ,H1H2,HRF,PSP] = get_vq_params(gf_iaif,gfd_iaif,fs,se_gci); % Estimate conventional glottal parameters///////////////////////////////////////////////////////////////////////

% Estimate the Rd parameter of the Liljencrants-Fant (LF) model
srh_f0(find(srh_f0==0)) = 100;
opt = sin_analysis();
opt.fharmonic  = true;
opt.use_ls     = false;
opt.debug = 0;
frames = sin_analysis(x, fs, [srh_time(:),srh_f0(:)], opt);
rds = rd_msp(frames, fs);

% Extract Cepstral Peak Prominence 
CPPv = cpp( x, fs, 1, 'mean' );%


